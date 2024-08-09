<?php

it('renders the page', function () {
    $this->get(route('unsubscribe.show'))
        ->assertOk()
        ->assertSeeText('Unsubscribe');
});
