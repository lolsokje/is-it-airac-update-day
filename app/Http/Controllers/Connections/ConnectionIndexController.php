<?php

declare(strict_types=1);

namespace App\Http\Controllers\Connections;

use Inertia\Response;
use Inertia\ResponseFactory;

final readonly class ConnectionIndexController
{
    public function __construct(
        private ResponseFactory $factory,
    ) {}

    public function __invoke(): Response
    {
        return $this->factory->render('Connections/Index');
    }
}
