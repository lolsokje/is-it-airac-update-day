<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Action\GetActiveCycle;
use App\Models\Subscription;
use App\Notifications\NewCycleAvailableNotification;
use Illuminate\Console\Command;
use Illuminate\Log\LogManager;
use Illuminate\Support\Collection;

final class AiracNotificationCommand extends Command
{
    protected $signature = 'notify:airac';

    protected $description = 'Checks whether notifications about a new AIRAC cycle being available need to be send';

    public function __construct(
        private readonly LogManager $logger,
    ) {
        parent::__construct();
    }

    public function handle(): int
    {
        $cycle = GetActiveCycle::handle();

        if (! $cycle->releasesToday()) {
            $this->info('No newly released cycle found');

            $this->logger->channel('command')->info('no new cycle found');

            return self::SUCCESS;
        }

        $subscribers = Subscription::query()
            ->where('cycle_id', '<', $cycle->id)
            ->orWhereNull('cycle_id');

        /** @var Collection<Subscription> $subscriptions */
        $subscribers->chunk(100, function (Collection $subscriptions) use ($cycle) {
            $subscriptions->each(fn (Subscription $subscription) => $subscription->notify(new NewCycleAvailableNotification($cycle)));
        });

        $this->logger->channel('command')->info("new cycle found, [{$subscribers->count()}] subscribers notified");

        return self::SUCCESS;
    }
}
