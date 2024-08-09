<?php

it('shows the right information', function (string $datetime, string $expectedResult, string $expectedDetail) {
    createCycles();

    $this->travelTo(new DateTime($datetime));

    $this->get(route('index'))
        ->assertSeeText($expectedResult)
        ->assertSeeText($expectedDetail);
})->with([
    ['2024-02-01 08:00:00', 'YES', 'should be'],
    ['2024-02-01 09:00:00', 'YES', 'now'],
    ['2024-02-02 09:00:00', 'NO', 'will be'],
]);
