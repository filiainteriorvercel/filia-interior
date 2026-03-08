<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory;

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

    protected static function booted(): void
    {
        static::creating(function (self $project): void {
            if (blank($project->project_code)) {
                $project->project_code = 'TMP-PROJECT-' . Str::upper((string) Str::ulid());
            }
        });

        static::created(function (self $project): void {
            if (str_starts_with($project->project_code, 'TMP-PROJECT-')) {
                $project->forceFill([
                    'project_code' => $project->generateProjectCode(),
                ])->saveQuietly();
            }
        });
    }

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

    public function generateProjectCode(): string
    {
        $baseCode = 'PRJ-' . str_pad((string) $this->id, 4, '0', STR_PAD_LEFT);
        $projectCode = $baseCode;
        $suffix = 1;

        while (static::query()
            ->where('project_code', $projectCode)
            ->whereKeyNot($this->id)
            ->exists()) {
            $projectCode = $baseCode . '-' . $suffix;
            $suffix++;
        }

        return $projectCode;
    }
}
