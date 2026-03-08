<?php

namespace App\Http\Controllers;

use App\Mail\ProgressUpdateNotification;
use App\Models\ProgressUpdate;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ProgressController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $search = '';

        if ($user->role === 'owner') {
            $search = trim((string) $request->get('q', ''));

            $query = ProgressUpdate::with(['user', 'project.user'])->latest();

            if ($search !== '') {
                $query->where(function ($builder) use ($search) {
                    $builder->where('id_project', 'like', "%{$search}%")
                        ->orWhere('deskripsi', 'like', "%{$search}%")
                        ->orWhereHas('project', function ($projectQuery) use ($search) {
                            $projectQuery->where('project_code', 'like', "%{$search}%")
                                ->orWhere('customer_name', 'like', "%{$search}%")
                                ->orWhere('customer_phone', 'like', "%{$search}%")
                                ->orWhere('customer_email', 'like', "%{$search}%");
                        })
                        ->orWhereHas('user', function ($userQuery) use ($search) {
                            $userQuery->where('name', 'like', "%{$search}%")
                                ->orWhere('email', 'like', "%{$search}%")
                                ->orWhere('customer_code', 'like', "%{$search}%")
                                ->orWhere('phone', 'like', "%{$search}%");
                        });
                });
            }

            $progressUpdates = $query->get();
        } else {
            $progressUpdates = ProgressUpdate::with('project')
                ->where('user_id', $user->id)
                ->latest()
                ->get();
        }

        return view('progress.index', compact('progressUpdates', 'search'));
    }

    public function create(Request $request)
    {
        if (Auth::user()->role !== 'owner') {
            abort(403, 'Unauthorized');
        }

        $projects = Project::with('user')->latest()->get();
        $selectedProjectId = $request->integer('project_id') ?: null;

        if ($selectedProjectId !== null && ! $projects->contains('id', $selectedProjectId)) {
            $selectedProjectId = null;
        }

        return view('progress.create', compact('projects', 'selectedProjectId'));
    }

    public function store(Request $request)
    {
        if (Auth::user()->role !== 'owner') {
            abort(403, 'Unauthorized');
        }

        $validated = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tanggal_update' => 'required|date',
            'status' => 'nullable|string|in:in_progress,completed,on_hold',
        ]);

        $project = Project::findOrFail($validated['project_id']);
        $validated['user_id'] = $project->user_id;
        $validated['id_project'] = $project->project_code;
        if (! empty($validated['status'])) {
            $project->update(['status' => $validated['status']]);
        }

        if ($uploadedFoto = $this->uploadImage($request, 'foto', 'images/progress', 'progress')) {
            $validated['foto'] = $uploadedFoto;
        }

        $progressUpdate = ProgressUpdate::create($validated);

        $customer = User::find($project->user_id);
        if ($customer && $customer->email) {
            try {
                Mail::to($customer->email)->send(new ProgressUpdateNotification($progressUpdate, $customer->name));
            } catch (\Exception $e) {
                Log::error('Failed to send progress update email: ' . $e->getMessage());
            }
        }

        return redirect()->route('progress.index')->with('success', 'Progress update berhasil ditambahkan dan email notifikasi telah dikirim!');
    }

    public function show(ProgressUpdate $progress)
    {
        $user = Auth::user();

        $belongsToUser = $progress->user_id === $user->id
            || ($progress->project && $progress->project->user_id === $user->id);

        if ($user->role !== 'owner' && ! $belongsToUser) {
            abort(403, 'Unauthorized');
        }

        $progress->load('project.user');
        return view('progress.show', compact('progress'));
    }

    public function edit(ProgressUpdate $progress)
    {
        if (Auth::user()->role !== 'owner') {
            abort(403, 'Unauthorized');
        }

        $projects = Project::with('user')->latest()->get();
        return view('progress.edit', compact('progress', 'projects'));
    }

    public function update(Request $request, ProgressUpdate $progress)
    {
        if (Auth::user()->role !== 'owner') {
            abort(403, 'Unauthorized');
        }

        $validated = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tanggal_update' => 'required|date',
            'status' => 'nullable|string|in:in_progress,completed,on_hold',
        ]);

        $project = Project::findOrFail($validated['project_id']);
        $validated['user_id'] = $project->user_id;
        $validated['id_project'] = $project->project_code;
        if (! empty($validated['status'])) {
            $project->update(['status' => $validated['status']]);
        }

        if ($uploadedFoto = $this->uploadImage($request, 'foto', 'images/progress', 'progress')) {
            $this->deleteLocalAsset($progress->foto);
            $validated['foto'] = $uploadedFoto;
        }

        $progress->update($validated);

        $customer = User::find($project->user_id);
        if ($customer && $customer->email) {
            try {
                Mail::to($customer->email)->send(new ProgressUpdateNotification($progress, $customer->name));
            } catch (\Exception $e) {
                Log::error('Failed to send progress update email: ' . $e->getMessage());
            }
        }

        return redirect()->route('progress.index')->with('success', 'Progress update berhasil diupdate dan email notifikasi telah dikirim!');
    }

    public function destroy(ProgressUpdate $progress)
    {
        if (Auth::user()->role !== 'owner') {
            abort(403, 'Unauthorized');
        }

        $this->deleteLocalAsset($progress->foto);

        $progress->delete();

        return redirect()->route('progress.index')->with('success', 'Progress update berhasil dihapus!');
    }

    private function uploadImage(Request $request, string $field, string $folder, string $filenamePrefix): ?string
    {
        if (! $request->hasFile($field)) {
            return null;
        }

        $file = $request->file($field);
        $filename = $filenamePrefix . '_' . time() . '.' . $file->getClientOriginalExtension();
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

    private function deleteLocalAsset(?string $path): void
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
