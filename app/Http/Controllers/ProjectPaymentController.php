<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectPayment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ProjectPaymentController extends Controller
{
    public function store(Request $request, Project $project): RedirectResponse
    {
        $this->ensureOwner();

        $validated = $request->validate([
            'payment_percent' => 'required|numeric|min:0.01|max:100',
            'payment_date' => 'required|date',
            'payment_proof' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
            'notes' => 'nullable|string',
        ]);
        $currentTotal = (float) $project->payments()->sum('payment_percent');
        $incomingPercent = (float) $validated['payment_percent'];
        if (($currentTotal + $incomingPercent) > 100.0) {
            return back()
                ->withErrors([
                    'payment_percent' => 'Total pembayaran melebihi 100%. Kurangi persentase pembayaran yang diinput.',
                ])
                ->withInput();
        }

        if ($proof = $this->handleProofUpload($request, 'payment_proof', 'images/payment-progress')) {
            $validated['payment_proof'] = $proof;
        }

        $validated['created_by'] = Auth::id();

        $project->payments()->create($validated);

        return back()->with('success', 'Histori pembayaran berhasil ditambahkan.');
    }

    public function destroy(Project $project, ProjectPayment $payment): RedirectResponse
    {
        $this->ensureOwner();

        if ($payment->project_id !== $project->id) {
            abort(404);
        }

        $this->deleteStoredAsset($payment->payment_proof);
        $payment->delete();

        return back()->with('success', 'Histori pembayaran berhasil dihapus.');
    }

    public function showProof(Project $project, ProjectPayment $payment): Response
    {
        $user = Auth::user();
        if (! $user->isOwner() && $project->user_id !== $user->id) {
            abort(403, 'Unauthorized action.');
        }

        if ($payment->project_id !== $project->id || ! $payment->payment_proof) {
            abort(404);
        }

        if (str_starts_with($payment->payment_proof, 'data:')) {
            if (! preg_match('/^data:(.*?);base64,(.*)$/', $payment->payment_proof, $matches)) {
                abort(404);
            }

            $binary = base64_decode($matches[2], true);
            if ($binary === false) {
                abort(404);
            }

            $mimeType = $matches[1] ?: 'application/octet-stream';

            return response($binary, 200)->header('Content-Type', $mimeType);
        }

        $fullPath = public_path($payment->payment_proof);
        if (! file_exists($fullPath)) {
            abort(404);
        }

        return response()->file($fullPath);
    }

    private function ensureOwner(): void
    {
        if (! Auth::user()->isOwner()) {
            abort(403, 'Unauthorized action.');
        }
    }

    private function handleProofUpload(Request $request, string $field, string $folder): ?string
    {
        if (! $request->hasFile($field)) {
            return null;
        }

        $file = $request->file($field);
        $filename = $field . '_' . time() . '.' . $file->getClientOriginalExtension();
        $uploadPath = public_path($folder);

        $useBase64Fallback = env('VERCEL_ENV') !== null;

        if (! $useBase64Fallback) {
            if (! file_exists($uploadPath) && ! mkdir($uploadPath, 0755, true) && ! is_dir($uploadPath)) {
                $useBase64Fallback = true;
            } elseif (! is_writable($uploadPath)) {
                $useBase64Fallback = true;
            }
        }

        if ($useBase64Fallback) {
            $imageData = base64_encode(file_get_contents($file->getRealPath()));
            $mimeType = $file->getMimeType();
            return 'data:' . $mimeType . ';base64,' . $imageData;
        }

        $file->move($uploadPath, $filename);
        return $folder . '/' . $filename;
    }

    private function deleteStoredAsset(?string $path): void
    {
        if (! $path || str_starts_with($path, 'data:')) {
            return;
        }

        $fullPath = public_path($path);
        if (file_exists($fullPath)) {
            unlink($fullPath);
        }
    }
}
