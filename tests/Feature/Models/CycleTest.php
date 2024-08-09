<?php

use App\Action\GetActiveCycle;
use App\Models\Cycle;

it('correctly determines whether the cycle was released today', function (string $date, bool $expectedResult) {
    createCycles();

    $this->travelTo(new DateTime($date));

    $cycle = GetActiveCycle::handle();

    $this->assertEquals($cycle->releasesToday(), $expectedResult);
})->with([
    ['2024-02-01', true],
    ['2024-02-02', false],
]);

test('it correctly whether the new cycle has been released', function (string $datetime, bool $expectedResult) {
    createCycles();

    $this->travelTo(new DateTime($datetime));

    $cycle = Cycle::query()->first();

    $this->assertEquals($expectedResult, $cycle->hasBeenReleased());
})->with([
    ['2024-01-01 08:00:00', false],
    ['2024-01-01 09:00:00', true],
    ['2024-01-02 08:00:00', false],
    ['2024-01-02 09:00:00', false],
]);
