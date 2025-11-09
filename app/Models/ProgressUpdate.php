<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProgressUpdate extends Model
{
    protected $fillable = [
        'user_id',
        'id_project',
        'foto',
        'deskripsi',
        'tanggal_update',
        'status'
    ];

    protected $casts = [
        'tanggal_update' => 'date'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
