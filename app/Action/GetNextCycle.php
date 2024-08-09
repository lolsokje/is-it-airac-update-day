<?php

declare(strict_types=1);

namespace App\Action;

use App\Models\Cycle;

final readonly class GetNextCycle
{
    public static function handle(Cycle $current): Cycle
    {
        return Cycle::query()
            ->where('id', '>', $current->id)
            ->first();
    }
}
