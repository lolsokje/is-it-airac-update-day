<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\View\Factory;

final readonly class ShowUnsubscribeFormController
{
    public function __construct(
        private Factory $viewFactory,
    ) {}

    public function __invoke(): View
    {
        return $this->viewFactory->make('unsubscribe');
    }
}
