<?php

use App\Models\Cycle;
use App\Models\Subscription;
use App\Notifications\NewCycleAvailableNotification;
use Illuminate\Notifications\Events\NotificationSent;

it('updates the subscriber to have received the latest AIRAC', function () {
    Notification::fake();

    $cycle = Cycle::factory()->create();
    $subscriber = Subscription::factory()->create();

    $event = new NotificationSent($subscriber, new NewCycleAvailableNotification($cycle), 'mail');
    event($event);

    $subscriber->refresh();

    $this->assertEquals($subscriber->cycle_id, $cycle->id);
});
