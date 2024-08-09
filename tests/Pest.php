<?php

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "uses()" function to bind a different classes or traits.
|
*/

use App\Models\Cycle;

uses(
    Tests\TestCase::class,
    Illuminate\Foundation\Testing\RefreshDatabase::class,
)->in('Feature');

function createCycles(): void
{
    Cycle::factory(3)->sequence(
        ['ident' => '2401', 'starts_at' => '2024-01-01'],
        ['ident' => '2402', 'starts_at' => '2024-02-01'],
        ['ident' => '2403', 'starts_at' => '2024-03-01'],
    )->create();
}
