<?php

use App\Models\Cycle;
use App\Models\Subscription;
use App\Notifications\NewCycleAvailableNotification;

it('renders the view', function () {
    $cycle = Cycle::factory()->create();
    $subscription = Subscription::factory()->create();

    $notification = new NewCycleAvailableNotification($cycle);

    $content = $notification->toMail($subscription);

    $this->assertEquals('New AIRAC cycle available', $content->subject);
    $this->assertStringContainsString($cycle->ident, $content->render());
});
