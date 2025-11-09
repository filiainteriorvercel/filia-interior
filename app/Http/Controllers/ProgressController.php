<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgressUpdate;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ProgressUpdateNotification;

class ProgressController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        if ($user->role === 'owner') {
            // Owner can see all progress
            $progressUpdates = ProgressUpdate::with('user')->latest()->get();
        } else {
            // Customer can only see their own progress
            $progressUpdates = ProgressUpdate::where('user_id', $user->id)->latest()->get();
        }

        return view('progress.index', compact('progressUpdates'));
    }

    public function create()
    {
        // Only owner can create progress updates
        if (Auth::user()->role !== 'owner') {
            abort(403, 'Unauthorized');
        }

        $customers = User::where('role', 'customer')->get();
        return view('progress.create', compact('customers'));
    }

    public function store(Request $request)
    {
        // Only owner can create progress updates
        if (Auth::user()->role !== 'owner') {
            abort(403, 'Unauthorized');
        }

        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'id_project' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tanggal_update' => 'required|date',
            'status' => 'nullable|string|in:in_progress,completed,on_hold',
        ]);

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $filename = 'progress_' . time() . '.' . $foto->getClientOriginalExtension();
            
            // Check if running on Vercel (serverless) - filesystem is read-only
            $isVercel = env('VERCEL_ENV') !== null || !is_writable(public_path('images/progress'));
            
            if ($isVercel) {
                // Serverless environment: Store image as base64 in database
                $imageData = base64_encode(file_get_contents($foto->getRealPath()));
                $mimeType = $foto->getMimeType();
                $validated['foto'] = 'data:' . $mimeType . ';base64,' . $imageData;
            } else {
                // Local environment: Store in public directory
                $uploadPath = public_path('images/progress');
                if (!file_exists($uploadPath)) {
                    mkdir($uploadPath, 0755, true);
                }
                $foto->move($uploadPath, $filename);
                $validated['foto'] = 'images/progress/' . $filename;
            }
        }

        $progressUpdate = ProgressUpdate::create($validated);

        // Kirim email notifikasi ke customer
        $customer = User::find($validated['user_id']);
        if ($customer && $customer->email) {
            try {
                Mail::to($customer->email)->send(new ProgressUpdateNotification($progressUpdate, $customer->name));
            } catch (\Exception $e) {
                \Log::error('Failed to send progress update email: ' . $e->getMessage());
            }
        }

        return redirect()->route('progress.index')->with('success', 'Progress update berhasil ditambahkan dan email notifikasi telah dikirim!');
    }

    public function show(ProgressUpdate $progress)
    {
        $user = Auth::user();
        
        // Check authorization
        if ($user->role !== 'owner' && $progress->user_id !== $user->id) {
            abort(403, 'Unauthorized');
        }

        return view('progress.show', compact('progress'));
    }

    public function edit(ProgressUpdate $progress)
    {
        // Only owner can edit progress
        if (Auth::user()->role !== 'owner') {
            abort(403, 'Unauthorized');
        }

        $customers = User::where('role', 'customer')->get();
        return view('progress.edit', compact('progress', 'customers'));
    }

    public function update(Request $request, ProgressUpdate $progress)
    {
        // Only owner can update progress
        if (Auth::user()->role !== 'owner') {
            abort(403, 'Unauthorized');
        }

        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'id_project' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tanggal_update' => 'required|date',
            'status' => 'nullable|string|in:in_progress,completed,on_hold',
        ]);

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $filename = 'progress_' . time() . '.' . $foto->getClientOriginalExtension();
            
            // Check if running on Vercel (serverless) - filesystem is read-only
            $isVercel = env('VERCEL_ENV') !== null || !is_writable(public_path('images/progress'));
            
            if ($isVercel) {
                // Serverless environment: Store image as base64 in database
                // No need to delete old photo (it's stored in database)
                $imageData = base64_encode(file_get_contents($foto->getRealPath()));
                $mimeType = $foto->getMimeType();
                $validated['foto'] = 'data:' . $mimeType . ';base64,' . $imageData;
            } else {
                // Local environment: Store in public directory
                // Delete old photo if it exists and is a file (not base64)
                if ($progress->foto && !str_starts_with($progress->foto, 'data:') && file_exists(public_path($progress->foto))) {
                    unlink(public_path($progress->foto));
                }
                
                $uploadPath = public_path('images/progress');
                if (!file_exists($uploadPath)) {
                    mkdir($uploadPath, 0755, true);
                }
                $foto->move($uploadPath, $filename);
                $validated['foto'] = 'images/progress/' . $filename;
            }
        }

        $progress->update($validated);

        // Kirim email notifikasi ke customer
        $customer = User::find($validated['user_id']);
        if ($customer && $customer->email) {
            try {
                Mail::to($customer->email)->send(new ProgressUpdateNotification($progress, $customer->name));
            } catch (\Exception $e) {
                \Log::error('Failed to send progress update email: ' . $e->getMessage());
            }
        }

        return redirect()->route('progress.index')->with('success', 'Progress update berhasil diupdate dan email notifikasi telah dikirim!');
    }

    public function destroy(ProgressUpdate $progress)
    {
        // Only owner can delete progress
        if (Auth::user()->role !== 'owner') {
            abort(403, 'Unauthorized');
        }

        // Delete photo file only if it's stored as file (not base64)
        // Base64 images are stored in database, so no file to delete
        if ($progress->foto && !str_starts_with($progress->foto, 'data:') && file_exists(public_path($progress->foto))) {
            unlink(public_path($progress->foto));
        }

        $progress->delete();

        return redirect()->route('progress.index')->with('success', 'Progress update berhasil dihapus!');
    }
}
