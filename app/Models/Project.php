<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    protected $fillable = [
        'project_code',
        'user_id',
        'customer_name',
        'customer_phone',
        'customer_email',
        'deal_date',
        'deal_payment_proof',
        'status',
        'notes',
    ];

    protected $casts = [
        'deal_date' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function progressUpdates(): HasMany
    {
        return $this->hasMany(ProgressUpdate::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(ProjectPayment::class)->latest('payment_date');
    }

    public function getTotalPaidPercentAttribute(): float
    {
        return (float) $this->payments()->sum('payment_percent');
    }
}
