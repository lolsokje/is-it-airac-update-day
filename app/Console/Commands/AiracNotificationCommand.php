<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Action\GetActiveCycle;
use App\Models\Subscription;
use App\Notifications\NewCycleAvailableNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;

final class AiracNotificationCommand extends Command
{
    protected $signature = 'notify:airac';

    protected $description = 'Checks whether notifications about a new AIRAC cycle being available need to be send';

    public function handle(): int
    {
        $cycle = GetActiveCycle::handle();

        if (! $cycle->releasesToday()) {
            $this->info('No newly released cycle found');

            return self::SUCCESS;
        }

        /** @var Collection<Subscription> $subscriptions */
        Subscription::query()->chunk(100, function (Collection $subscriptions) use ($cycle) {
            $subscriptions->each(fn (Subscription $subscription) => $subscription->notify(new NewCycleAvailableNotification($cycle)));
        });

        return self::SUCCESS;
    }
}
