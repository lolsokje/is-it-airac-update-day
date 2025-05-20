<?php

declare(strict_types=1);

namespace App\Http\Controllers\Profile\Discord;

use App\Models\DiscordWebhook;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Symfony\Component\HttpFoundation\RedirectResponse;

final readonly class DestroyDiscordWebhookController
{
    use AuthorizesRequests;

    public function __invoke(
        DiscordWebhook $webhook,
    ): RedirectResponse {
        $this->authorize('delete', $webhook);

        $webhook->delete();

        return to_route('profile.index')
            ->with('success', 'Webhook has been deleted');
    }
}
