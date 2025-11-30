<?php

namespace App\Mail;

use App\Models\ProgressUpdate;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ProgressUpdateNotification extends Mailable
{
    use SerializesModels;

    public $progressUpdate;
    public $customerName;

    /**
     * Create a new message instance.
     */
    public function __construct(ProgressUpdate $progressUpdate, $customerName)
    {
        $this->progressUpdate = $progressUpdate;
        $this->customerName = $customerName;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Update Progress Project Anda - ' . $this->progressUpdate->id_project,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.progress-update',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        // If foto is base64, convert to attachment
        if ($this->progressUpdate->foto && str_starts_with($this->progressUpdate->foto, 'data:')) {
            try {
                // Extract base64 data
                preg_match('/^data:image\/(\w+);base64,/', $this->progressUpdate->foto, $matches);
                $extension = $matches[1] ?? 'jpg';
                $base64Data = substr($this->progressUpdate->foto, strpos($this->progressUpdate->foto, ',') + 1);
                $imageData = base64_decode($base64Data);
                
                // Save to temp file
                $tempPath = sys_get_temp_dir() . '/progress_' . $this->progressUpdate->id . '.' . $extension;
                file_put_contents($tempPath, $imageData);
                
                return [
                    \Illuminate\Mail\Mailables\Attachment::fromPath($tempPath)
                        ->as('progress_foto.' . $extension)
                        ->withMime('image/' . $extension)
                ];
            } catch (\Exception $e) {
                \Log::error('Failed to attach progress photo: ' . $e->getMessage());
                return [];
            }
        }
        
        return [];
    }
}
