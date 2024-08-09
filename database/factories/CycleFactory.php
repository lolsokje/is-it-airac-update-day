<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Cycle;
use Illuminate\Database\Eloquent\Factories\Factory;

final class CycleFactory extends Factory
{
    protected $model = Cycle::class;

    public function definition(): array
    {
        return [
            'cycle' => $this->faker->numberBetween(1, 13),
            'ident' => $this->faker->numerify('####'),
            'starts_at' => $this->faker->date(),
        ];
    }
}
