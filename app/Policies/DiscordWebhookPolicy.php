<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\DiscordWebhook;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

final class DiscordWebhookPolicy
{
    use HandlesAuthorization;

    public function update(User $user, DiscordWebhook $discordWebhook): bool
    {
        return $user->id === $discordWebhook->user_id;
    }

    public function delete(User $user, DiscordWebhook $discordWebhook): bool
    {
        return $user->id === $discordWebhook->user_id;
    }
}
