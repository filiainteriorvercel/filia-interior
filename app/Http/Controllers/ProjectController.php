<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class ProjectController extends Controller
{
    public function index(Request $request): View
    {
        $user = Auth::user();
        $search = trim((string) $request->get('q', ''));

        if ($user->isOwner()) {
            $projectsQuery = Project::with(['user', 'payments']);

            if ($search !== '') {
                $projectsQuery->where(function ($query) use ($search) {
                    $query->where('project_code', 'like', "%{$search}%")
                        ->orWhere('customer_name', 'like', "%{$search}%")
                        ->orWhere('customer_phone', 'like', "%{$search}%")
                        ->orWhere('customer_email', 'like', "%{$search}%")
                        ->orWhereHas('user', function ($userQuery) use ($search) {
                            $userQuery->where('customer_code', 'like', "%{$search}%")
                                ->orWhere('name', 'like', "%{$search}%")
                                ->orWhere('email', 'like', "%{$search}%")
                                ->orWhere('phone', 'like', "%{$search}%");
                        });
                });
            }

            $projects = $projectsQuery->latest()->paginate(15)->withQueryString();
        } else {
            $projects = Project::with(['user', 'payments'])
                ->where('user_id', $user->id)
                ->latest()
                ->paginate(15)
                ->withQueryString();
        }

        return view('dashboard.projects.index', compact('projects', 'search'));
    }

    public function create(): View
    {
        $this->ensureOwner();

        $customers = User::where('role', 'customer')->orderBy('name')->get();
        return view('dashboard.projects.create', compact('customers'));
    }

    public function store(Request $request): RedirectResponse
    {
        $this->ensureOwner();

        $validated = $request->validate($this->rules());

        if ($proof = $this->handleProofUpload($request, 'deal_payment_proof', 'images/deal-payments')) {
            $validated['deal_payment_proof'] = $proof;
        }

        $project = Project::create($validated);

        return redirect()
            ->route('dashboard.projects.show', $project)
            ->with('success', 'Project berhasil ditambahkan.');
    }

    public function show(Project $project): View
    {
        $this->ensureOwnerOrProjectOwner($project);

        $project->load([
            'user',
            'progressUpdates' => fn ($query) => $query->latest('tanggal_update'),
            'payments' => fn ($query) => $query->latest('payment_date'),
            'payments.creator',
        ]);

        return view('dashboard.projects.show', compact('project'));
    }

    public function showDealProof(Project $project): Response
    {
        $this->ensureOwnerOrProjectOwner($project);

        if (! $project->deal_payment_proof) {
            abort(404);
        }

        if (str_starts_with($project->deal_payment_proof, 'data:')) {
            if (! preg_match('/^data:(.*?);base64,(.*)$/', $project->deal_payment_proof, $matches)) {
                abort(404);
            }

            $binary = base64_decode($matches[2], true);
            if ($binary === false) {
                abort(404);
            }

            $mimeType = $matches[1] ?: 'application/octet-stream';

            return response($binary, 200)->header('Content-Type', $mimeType);
        }

        $fullPath = public_path($project->deal_payment_proof);
        if (! file_exists($fullPath)) {
            abort(404);
        }

        return response()->file($fullPath);
    }

    public function edit(Project $project): View
    {
        $this->ensureOwner();

        $customers = User::where('role', 'customer')->orderBy('name')->get();
        return view('dashboard.projects.edit', compact('project', 'customers'));
    }

    public function update(Request $request, Project $project): RedirectResponse
    {
        $this->ensureOwner();

        $validated = $request->validate($this->rules());

        if ($proof = $this->handleProofUpload($request, 'deal_payment_proof', 'images/deal-payments')) {
            $this->deleteStoredAsset($project->deal_payment_proof);
            $validated['deal_payment_proof'] = $proof;
        }

        $project->update($validated);

        return redirect()
            ->route('dashboard.projects.show', $project)
            ->with('success', 'Project berhasil diperbarui.');
    }

    public function destroy(Project $project): RedirectResponse
    {
        $this->ensureOwner();

        $this->deleteStoredAsset($project->deal_payment_proof);
        foreach ($project->payments as $payment) {
            $this->deleteStoredAsset($payment->payment_proof);
        }

        $project->delete();

        return redirect()
            ->route('dashboard.projects.index')
            ->with('success', 'Project berhasil dihapus.');
    }

    private function ensureOwner(): void
    {
        if (! Auth::user()->isOwner()) {
            abort(403, 'Unauthorized action.');
        }
    }

    private function ensureOwnerOrProjectOwner(Project $project): void
    {
        $user = Auth::user();
        if (! $user->isOwner() && $project->user_id !== $user->id) {
            abort(403, 'Unauthorized action.');
        }
    }

    private function rules(): array
    {
        return [
            'user_id' => [
                'required',
                Rule::exists('users', 'id')->where(fn ($query) => $query->where('role', 'customer')),
            ],
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'nullable|string|max:25',
            'customer_email' => 'required|email|max:255',
            'deal_date' => 'required|date',
            'deal_payment_proof' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
            'status' => 'required|string|in:in_progress,completed,on_hold,cancelled',
            'notes' => 'nullable|string',
        ];
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
