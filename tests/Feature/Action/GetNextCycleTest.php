<?php

use App\Action\GetNextCycle;
use App\Models\Cycle;

it('returns the next cycle based on the provided cycle', function () {
    createCycles();

    $cycle = Cycle::query()->first();

    $nextCycle = GetNextCycle::handle($cycle);

    $this->assertEquals('2401', $cycle->ident);
    $this->assertEquals('2402', $nextCycle->ident);
});
