<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Action\GetActiveCycle;
use App\Action\GetNextCycle;
use Illuminate\Contracts\View\View;
use Illuminate\View\Factory;

final readonly class IndexController
{
    public function __construct(
        private Factory $viewFactory,
    ) {}

    public function __invoke(): View
    {
        $currentCycle = GetActiveCycle::handle();
        $nextCycle = GetNextCycle::handle($currentCycle);

        return $this->viewFactory->make('index', [
            'current' => $currentCycle,
            'next' => $nextCycle,
            'releasesToday' => $currentCycle->releasesToday(),
            'hasBeenReleased' => $currentCycle->hasBeenReleased(),
        ]);
    }
}
