<?php

declare(strict_types=1);

namespace App\Action;

use App\Models\Cycle;
use Carbon\Carbon;

final readonly class GetActiveCycle
{
    public static function handle(): Cycle
    {
        return Cycle::query()
            ->where('starts_at', '<=', Carbon::now()->format('Y-m-d'))
            ->orderByDesc('starts_at')
            ->first();
    }
}
