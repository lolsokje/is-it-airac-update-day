<?php

declare(strict_types=1);

namespace App\Support;

use App\Models\Subscription;
use Throwable;

final readonly class UnsubscribeTokenGenerator
{
    public static function createToken(Subscription $subscription): string
    {
        return encrypt($subscription->email);
    }

    public static function findSubscription(?string $token = ''): ?Subscription
    {
        try {
            $email = decrypt($token);
        } catch (Throwable) {
            return null;
        }

        $subscription = Subscription::query()
            ->where('email', $email)
            ->first();

        if (! $subscription) {
            return null;
        }

        return $subscription;
    }
}
