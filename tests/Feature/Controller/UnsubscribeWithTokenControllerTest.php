<?php

use App\Models\Subscription;

test('users can unsubscribe by clicking a link', function () {
    $subscription = Subscription::factory()->create();

    $token = encrypt($subscription->email);

    $this->get(route('subscription.destroy.token', $token))
        ->assertRedirectToRoute('index')
        ->assertSessionHas('success');

    $this->assertCount(0, Subscription::query()->get());
});

it('silently fails when no valid token is provided', function (string $token) {
    Subscription::factory()->create();

    $this->get(route('subscription.destroy.token', $token))
        ->assertRedirectToRoute('index')
        ->assertSessionMissing(['success', 'error']);

    $this->assertCount(1, Subscription::query()->get());
})->with([
    ['test@example.com'],
    [''],
    ['123'],
]);
