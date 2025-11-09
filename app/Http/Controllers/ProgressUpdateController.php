<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgressUpdate;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ProgressUpdateNotification;

class ProgressUpdateController extends Controller
{
    public function index()
    {
        if (Auth::user()->isOwner()) {
            $progressUpdates = ProgressUpdate::with('user')->latest('tanggal_update')->get();
        } else {
            $progressUpdates = ProgressUpdate::where('user_id', Auth::id())->latest('tanggal_update')->get();
        }

        return view('progress.index', compact('progressUpdates'));
    }

    public function create()
    {
        if (!Auth::user()->isOwner()) {
            abort(403, 'Unauthorized action.');
        }

        $customers = User::where('role', 'customer')->get();
        return view('progress.create', compact('customers'));
    }

    public function store(Request $request)
    {
        if (!Auth::user()->isOwner()) {
            abort(403, 'Unauthorized action.');
        }


        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'id_project' => 'required|string|max:255',
            'tanggal_update' => 'required|date',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
        ]);

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $filename = 'progress_' . time() . '.' . $foto->getClientOriginalExtension();
            $foto->move(public_path('images/progress'), $filename);
            $validated['foto'] = 'images/progress/' . $filename;
        }

        $progressUpdate = ProgressUpdate::create($validated);

        // Kirim email notifikasi ke customer
        $customer = User::find($validated['user_id']);
        if ($customer && $customer->email) {
            try {
                Mail::to($customer->email)->send(new ProgressUpdateNotification($progressUpdate, $customer->name));
            } catch (\Exception $e) {
                // Log error tapi tetap lanjut (tidak menghentikan proses)
                \Log::error('Failed to send progress update email: ' . $e->getMessage());
            }
        }

        return redirect()->route('progress.index')->with('success', 'Progress update berhasil ditambahkan dan email notifikasi telah dikirim!');
    }

    public function edit(ProgressUpdate $progressUpdate)
    {
        if (!Auth::user()->isOwner()) {
            abort(403, 'Unauthorized action.');
        }

        $customers = User::where('role', 'customer')->get();
        return view('progress.edit', compact('progressUpdate', 'customers'));
    }

    public function update(Request $request, ProgressUpdate $progressUpdate)
    {
        if (!Auth::user()->isOwner()) {
            abort(403, 'Unauthorized action.');
        }

        try {
            $validated = $request->validate([
                'user_id' => 'required|exists:users,id',
                'id_project' => 'required|string|max:255',
                'tanggal_update' => 'required|date',
                'deskripsi' => 'required|string',
                'status' => 'nullable|string|in:in_progress,completed,on_hold',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            ]);

            if ($request->hasFile('foto')) {
                // Delete old photo
                if ($progressUpdate->foto && file_exists(public_path($progressUpdate->foto))) {
                    unlink(public_path($progressUpdate->foto));
                }

                $foto = $request->file('foto');
                $filename = 'progress_' . time() . '.' . $foto->getClientOriginalExtension();
                $foto->move(public_path('images/progress'), $filename);
                $validated['foto'] = 'images/progress/' . $filename;
            }

            $progressUpdate->update($validated);

            // Kirim email notifikasi ke customer jika ada perubahan
            $customer = User::find($validated['user_id']);
            if ($customer && $customer->email) {
                try {
                    Mail::to($customer->email)->send(new ProgressUpdateNotification($progressUpdate, $customer->name));
                } catch (\Exception $e) {
                    \Log::error('Failed to send progress update email: ' . $e->getMessage());
                }
            }

            return redirect()->route('progress.index')->with('success', 'Progress update berhasil diperbarui dan email notifikasi telah dikirim!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi error: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy(ProgressUpdate $progressUpdate)
    {
        if (!Auth::user()->isOwner()) {
            abort(403, 'Unauthorized action.');
        }

        // Delete photo file
        if ($progressUpdate->foto && file_exists(public_path($progressUpdate->foto))) {
            unlink(public_path($progressUpdate->foto));
        }

        $progressUpdate->delete();

        return redirect()->route('progress.index')->with('success', 'Progress update berhasil dihapus!');
    }
}
