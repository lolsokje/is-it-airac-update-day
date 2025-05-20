<?php

declare(strict_types=1);

namespace App\Http\Controllers\Profile\Discord;

use App\Http\Requests\Profile\Discord\StoreDiscordWebhookRequest;
use Auth;
use Illuminate\Http\RedirectResponse;

final readonly class StoreDiscordWebhookController
{
    public function __invoke(
        StoreDiscordWebhookRequest $request,
    ): RedirectResponse {
        Auth::user()->discordWebhooks()->create([
            ...$request->validated(),
            'enabled' => true,
        ]);

        return to_route('profile.index')
            ->with('success', 'Discord webhook has been added');
    }
}
