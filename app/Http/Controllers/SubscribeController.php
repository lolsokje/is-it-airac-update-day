<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\SubscribeRequest;
use App\Models\Subscription;
use Symfony\Component\HttpFoundation\RedirectResponse;

final readonly class SubscribeController
{
    public function __invoke(SubscribeRequest $request): RedirectResponse
    {
        Subscription::query()->create($request->validated());

        return to_route('index')
            ->with('success', "You have successfully subscribed, you'll now receive an email whenever a new AIRAC has been released");
    }
}
