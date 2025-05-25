<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CompletedDiscordWebhooks extends Model
{
    use HasUuids;

    public $timestamps = false;

    public function discordWebhook(): BelongsTo
    {
        return $this->belongsTo(DiscordWebhook::class);
    }

    public function cycle(): BelongsTo
    {
        return $this->belongsTo(Cycle::class);
    }
}
