<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\AvailableProviders;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasUuids;
    use \Illuminate\Auth\Authenticatable;

    public function connections(): HasMany
    {
        return $this->hasMany(Connection::class);
    }

    public function discordWebhooks(): HasMany
    {
        return $this->hasMany(DiscordWebhook::class);
    }

    public function hasConnection(AvailableProviders $provider): bool
    {
        return $this->connections->where('provider', $provider)->isNotEmpty();
    }
}
