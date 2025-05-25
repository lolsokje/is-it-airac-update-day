<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DiscordWebhook extends Model
{
    use HasUuids;

    protected $casts = [
        'enabled' => 'bool',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function completedDiscordWebhooks(): HasMany
    {
        return $this->hasMany(CompletedDiscordWebhooks::class);
    }

    public function hasBeenCompletedForCycle(Cycle $cycle): bool
    {
        return $this->completedDiscordWebhooks()
            ->where('cycle_id', $cycle->id)
            ->exists();
    }

    public function markAsCompletedForCycle(Cycle $cycle): void
    {
        $this->completedDiscordWebhooks()
            ->create([
                'cycle_id' => $cycle->id,
            ]);
    }
}
