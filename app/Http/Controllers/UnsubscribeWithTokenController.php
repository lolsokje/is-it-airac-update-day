<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Support\UnsubscribeTokenGenerator;
use Symfony\Component\HttpFoundation\RedirectResponse;

final readonly class UnsubscribeWithTokenController
{
    public function __invoke(?string $token = ''): RedirectResponse
    {
        $subscription = UnsubscribeTokenGenerator::findSubscription($token);

        if (! $subscription) {
            return to_route('index');
        }

        $subscription->delete();

        return to_route('index')
            ->with('success', "You have successfully unsubscribed, you'll no longer receive updates about new AIRAC cycles");
    }
}
