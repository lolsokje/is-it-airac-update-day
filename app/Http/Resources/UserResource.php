<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin User */
final class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'email_address' => $this->email_address,
            'connections' => ConnectionResource::collection($this->whenLoaded('connections')),
            'discord_webhooks' => DiscordWebhookResource::collection($this->whenLoaded('discordWebhooks')),
        ];
    }
}
