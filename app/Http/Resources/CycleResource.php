<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Cycle;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Cycle */
final class CycleResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'cycle' => $this->cycle,
            'ident' => $this->ident,
            'starts_at' => DateResource::make($this->starts_at),
        ];
    }
}
