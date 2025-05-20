<?php

declare(strict_types=1);

namespace App\Http\Controllers\Profile;

use App\Http\Resources\UserResource;
use Inertia\Response;
use Inertia\ResponseFactory;

final readonly class ProfileIndexController
{
    public function __construct(
        private ResponseFactory $factory,
    ) {}

    public function __invoke(): Response
    {
        return $this->factory->render('Profile/Index', [
            'user' => UserResource::make(auth()->user()->load('connections', 'discordWebhooks')),
        ]);
    }
}
