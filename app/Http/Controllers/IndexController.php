<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Action\GetActiveCycle;
use App\Action\GetNextCycle;
use App\Http\Resources\CycleResource;
use Inertia\Response;
use Inertia\ResponseFactory;

final readonly class IndexController
{
    public function __construct(
        private ResponseFactory $factory,
    ) {}

    public function __invoke(): Response
    {
        $currentCycle = GetActiveCycle::handle();
        $nextCycle = GetNextCycle::handle($currentCycle);

        return $this->factory->render('Index', [
            'current' => CycleResource::make($currentCycle),
            'next' => CycleResource::make($nextCycle),
            'releasesToday' => $currentCycle->releasesToday(),
            'hasBeenReleased' => $currentCycle->hasBeenReleased(),
        ]);
    }
}
