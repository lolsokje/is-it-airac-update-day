<?php

declare(strict_types=1);

namespace App\Http\Controllers\Profile\Discord;

use App\Http\Requests\Profile\Discord\StoreDiscordWebhookRequest;
use App\Models\DiscordWebhook;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;

final readonly class UpdateDiscordWebhookController
{
    use AuthorizesRequests;

    public function __invoke(
        StoreDiscordWebhookRequest $request,
        DiscordWebhook $webhook,
    ): RedirectResponse {
        $this->authorize('update', $webhook);

        $webhook->update($request->validated());

        return to_route('profile.index')
            ->with('success', 'Webhook has been updated');
    }
}
