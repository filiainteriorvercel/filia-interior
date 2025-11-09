<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Progress extends Model
{
    protected $fillable = [
        'customer_id',
        'project_name',
        'description',
        'image',
        'status',
        'estimated_completion'
    ];

    protected $casts = [
        'estimated_completion' => 'date'
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'customer_id');
    }
}
