<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Carbon */
final class DateResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'formatted' => $this->format('F jS, Y'),
        ];
    }
}
