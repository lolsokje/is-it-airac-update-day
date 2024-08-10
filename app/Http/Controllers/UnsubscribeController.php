<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UnsubscribeRequest;
use App\Models\Subscription;
use Symfony\Component\HttpFoundation\RedirectResponse;

final readonly class UnsubscribeController
{
    public function __invoke(UnsubscribeRequest $request): RedirectResponse
    {
        Subscription::query()
            ->where('email', $request->validated('email'))
            ->first()
            ->delete();

        return to_route('index')
            ->with('success', "You have successfully unsubscribed, you'll no longer receive AIRAC updates");
    }
}
