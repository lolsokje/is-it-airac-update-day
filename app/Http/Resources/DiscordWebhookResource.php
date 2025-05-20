<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\DiscordWebhook;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin DiscordWebhook */
final class DiscordWebhookResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'webhook_url' => $this->webhook_url,
            'name' => $this->name,
            'enabled' => $this->enabled,
        ];
    }
}
