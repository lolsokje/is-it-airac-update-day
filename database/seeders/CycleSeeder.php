<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Cycle;
use DateTime;
use Illuminate\Database\Seeder;

final class CycleSeeder extends Seeder
{
    public function run(): void
    {
        $years = [];

        $date = new DateTime('2024-01-25');

        $year = 2024;

        while ($year < 2030) {
            $cycle = isset($years[$year]) ? count($years[$year]) + 1 : 1;

            $identYear = substr("$year", -2);
            $identMonth = str_pad("$cycle", 2, '0', STR_PAD_LEFT);

            $years[$year][] = [
                'cycle' => $cycle,
                'ident' => "$identYear$identMonth",
                'starts_at' => $date->format('Y-m-d'),
            ];

            $date->modify('+28 days');
            $year = (int) $date->format('Y');
        }

        foreach ($years as $cycles) {
            foreach ($cycles as $cycle) {
                Cycle::insert($cycle);
            }
        }
    }
}
