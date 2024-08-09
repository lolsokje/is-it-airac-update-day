<?php

use App\Action\GetActiveCycle;

it('returns the active AIRAC cycle', function (string $date) {
    createCycles();

    $this->travelTo(new DateTime($date));

    $this->assertEquals('2402', GetActiveCycle::handle()->ident);

    $this->travelBack();
})
    ->with([
        ['2024-02-01'],
        ['2024-02-10'],
        ['2024-02-28'],
    ]);
