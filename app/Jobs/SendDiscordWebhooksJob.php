<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Models\Cycle;
use App\Models\DiscordWebhook;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\Attributes\WithoutRelations;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

final class SendDiscordWebhooksJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public int $tries = 0;

    public int $maxExceptions = 3;

    private const string DISCORD_WEBHOOK_RATE_LIMIT_KEY = 'discord.webhook.rate-limit';

    public function __construct(
        #[WithoutRelations]
        private readonly DiscordWebhook $discordWebhook,
        #[WithoutRelations]
        private readonly Cycle $cycle,
    ) {}

    public function handle(): void
    {
        if ($this->discordWebhook->hasBeenCompletedForCycle($this->cycle)) {
            return;
        }

        if ($timestamp = Cache::get(self::DISCORD_WEBHOOK_RATE_LIMIT_KEY)) {
            $this->release($timestamp - time());

            return;
        }

        $response = Http::acceptJson()
            ->timeout(10)
            ->post($this->discordWebhook->webhook_url, [
                'content' => "It's time to update your AIRAC cycles again! Cycle **{$this->cycle->ident}** will or has been released today, at **0900Z**.\n\nThe new cycle can be installed using the Navigraph Hub (MSFS 2020 and 2024) or the FMS Data Manager (X-Plane, Prepar3D and FSX).\n\nBoth can be downloaded [on the Navigraph website](https://navigraph.com/downloads).\n\n-# Powered by [isitairacupdateday.com](https://isitairacupdateday.com).",
                'username' => 'Is it AIRAC Update Day?',
                'flags' => 4, // suppress link embeds
            ]);

        if ($response->failed() && $response->tooManyRequests()) {
            $secondsRemaining = (int) $response->header('x-ratelimit-reset-after');

            Cache::put(
                key: self::DISCORD_WEBHOOK_RATE_LIMIT_KEY,
                value: now()->addSeconds($secondsRemaining)->timestamp,
                ttl: $secondsRemaining,
            );

            $this->release($secondsRemaining);

            return;
        }

        $this->discordWebhook->markAsCompletedForCycle($this->cycle);
    }

    public function retryUntil(): Carbon
    {
        return now()->addHours(12);
    }
}
