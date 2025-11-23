<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telepon' => 'required|string|max:20',
            'subject' => 'required|string|max:255',
            'pesan' => 'required|string',
        ]);

        $contact = Contact::create($validated);

        // Send email notification
        try {
            // Sending to the admin email defined in .env or a default one
            \Illuminate\Support\Facades\Mail::to(config('mail.from.address'))->send(new \App\Mail\ContactFormSubmitted($validated));
            
            // Sending confirmation email to the customer
            \Illuminate\Support\Facades\Mail::to($validated['email'])->send(new \App\Mail\ContactFormConfirmation($validated));
        } catch (\Exception $e) {
            // Log error but don't stop the process
            \Illuminate\Support\Facades\Log::error('Failed to send contact email: ' . $e->getMessage());
        }

        return redirect()->route('contact')->with('success', 'Pesan Anda berhasil dikirim! Kami akan segera menghubungi Anda.');
    }
}
