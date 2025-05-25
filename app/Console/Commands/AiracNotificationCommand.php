<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Action\GetActiveCycle;
use App\Jobs\SendDiscordWebhooksJob;
use App\Models\Cycle;
use App\Models\DiscordWebhook;
use Illuminate\Console\Command;
use Illuminate\Log\LogManager;

final class AiracNotificationCommand extends Command
{
    protected $signature = 'notify:airac';

    protected $description = 'Checks whether notifications about a new AIRAC cycle being available need to be sent';

    private ?Cycle $activeCycle = null;

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

        $this->activeCycle = $cycle;

        $this->notifyWebhooks();

        return self::SUCCESS;
    }

    private function notifyWebhooks(): void
    {
        $webhooks = DiscordWebhook::query()
            ->where('enabled', true)
            ->get();

        foreach ($webhooks as $webhook) {
            SendDiscordWebhooksJob::dispatch($webhook, $this->activeCycle);
        }
    }
}
