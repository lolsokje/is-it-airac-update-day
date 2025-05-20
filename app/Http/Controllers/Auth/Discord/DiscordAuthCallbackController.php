<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth\Discord;

use App\Enums\AvailableProviders;
use App\Models\Connection;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use SocialiteProviders\Manager\OAuth2\User as SocialiteUser;
use Symfony\Component\HttpFoundation\RedirectResponse;

final readonly class DiscordAuthCallbackController
{
    public function __invoke(): RedirectResponse
    {
        /** @var SocialiteUser $discordUser */
        $discordUser = Socialite::driver('discord')->user();

        $user = User::query()->firstOrCreate([
            'email_address' => $discordUser->getEmail(),
        ]);

        Connection::query()->firstOrCreate([
            'user_id' => $user->id,
            'provider' => AvailableProviders::DISCORD,
            'provider_id' => $discordUser->getId(),
        ], [
            'access_token' => $discordUser->token,
            'refresh_token' => $discordUser->refreshToken,
        ]);

        Auth::login($user);

        return to_route('profile.index')
            ->with('success', 'Successfully signed in using Discord');
    }
}
