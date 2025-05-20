<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Connection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Connection */
final class ConnectionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'provider' => $this->provider,
            'provider_id' => $this->provider_id,
            'access_token' => $this->access_token,
            'refresh_token' => $this->refresh_token,
        ];
    }
}
