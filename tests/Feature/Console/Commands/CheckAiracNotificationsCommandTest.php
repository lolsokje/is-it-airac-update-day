<?php

use App\Action\GetActiveCycle;
use App\Models\Subscription;
use App\Notifications\NewCycleAvailableNotification;
use Illuminate\Support\Facades\Log;

beforeEach(function () {
    // Disable logging in these tests
    Log::shouldReceive('channel->info')
        ->once()
        ->andReturnNull();
});

it('does not send notifications when there is no new cycle', function () {
    createCycles();

    $this->travelTo(new DateTime('2024-02-02'));

    $this->artisan('notify:airac')
        ->assertOk()
        ->expectsOutput('No newly released cycle found');
});

it('queues notification emails to all subscribers when a new airac cycle is available', function () {
    Notification::fake();

    createCycles();

    $subscriptions = Subscription::factory(3)->create();

    $this->travelTo(new DateTime('2024-02-01'));

    $this->artisan('notify:airac')
        ->assertOk();

    Notification::assertCount(3);

    Notification::assertSentTo($subscriptions, NewCycleAvailableNotification::class, function (NewCycleAvailableNotification $notification) {
        return $notification->cycle->ident === '2402';
    });
});

it('can queue hundreds of emails', function () {
    Notification::fake();

    createCycles();

    $subscriptions = Subscription::factory(1000)->create();

    $this->travelTo(new DateTime('2024-02-01'));

    $this->artisan('notify:airac')
        ->assertOk();

    Notification::assertCount(1000);

    Notification::assertSentTo($subscriptions, NewCycleAvailableNotification::class, function (NewCycleAvailableNotification $notification) {
        return $notification->cycle->ident === '2402';
    });
});

it('does not sent notifications to subscribers who have already received a notification about the current cycle', function () {
    Notification::fake();

    createCycles();

    $this->travelTo(new DateTime('2024-02-01'));

    $cycle = GetActiveCycle::handle();

    $subscriber = Subscription::factory()->create(['cycle_id' => $cycle->id]);

    $this->artisan('notify:airac')
        ->assertOk();

    Notification::assertCount(0);
    Notification::assertNotSentTo($subscriber, NewCycleAvailableNotification::class);
});
