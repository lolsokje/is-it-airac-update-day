<?php

use App\Models\Subscription;

test('users can unsubscribe', function () {
    Subscription::factory()->create([
        'email_address' => 'test@example.com',
    ]);

    $this->delete(route('subscription.destroy'), [
        'email_address' => 'test@example.com',
    ])
        ->assertRedirectToRoute('index')
        ->assertSessionHas('success');

    $this->assertCount(0, Subscription::query()->get());
});

test('the user must have subscribed to be able to unsubscribe', function () {
    $this->from(route('unsubscribe.show'))
        ->delete(route('subscription.destroy'), [
            'email_address' => 'test@example.com',
        ])
        ->assertRedirectToRoute('unsubscribe.show')
        ->assertInvalid('email_address');

    $this->assertCount(0, Subscription::query()->get());
});
