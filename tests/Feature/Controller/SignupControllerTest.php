<?php

use App\Models\Subscription;

test('users can subscribe', function () {
    $this->post(route('subscription.store'), [
        'email_address' => 'test@example.com',
    ])
        ->assertRedirectToRoute('index')
        ->assertSessionHas('success');

    $this->assertCount(1, Subscription::query()->get());
});

test('the provided email address must be unique', function () {
    Subscription::factory()->create(['email_address' => 'test@example.com']);

    $this->post(route('subscription.store'), [
        'email_address' => 'test@example.com',
    ])
        ->assertRedirectToRoute('index')
        ->assertInvalid('email_address');

    $this->assertCount(1, Subscription::query()->get());
});

test('the provided email address must be valid', function (string $emailAddress) {
    $this->post(route('subscription.store'), [
        'email_address' => $emailAddress,
    ])
        ->assertRedirectToRoute('index')
        ->assertInvalid('email_address');

    $this->assertCount(0, Subscription::query()->get());
})->with([
    ['test.com'],
    ['invalid'],
    ['123'],
]);
