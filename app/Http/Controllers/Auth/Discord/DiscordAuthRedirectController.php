<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth\Discord;

use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\RedirectResponse;

final readonly class DiscordAuthRedirectController
{
    public function __invoke(): RedirectResponse
    {
        return Socialite::driver('discord')->redirect();
    }
}
