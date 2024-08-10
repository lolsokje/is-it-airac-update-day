<?php

use App\Models\Subscription;

test('users can subscribe', function () {
    $this->post(route('subscription.store'), [
        'email' => 'test@example.com',
    ])
        ->assertRedirectToRoute('index')
        ->assertSessionHas('success');

    $this->assertCount(1, Subscription::query()->get());
});

test('the provided email address must be unique', function () {
    Subscription::factory()->create(['email' => 'test@example.com']);

    $this->post(route('subscription.store'), [
        'email' => 'test@example.com',
    ])
        ->assertRedirectToRoute('index')
        ->assertInvalid('email');

    $this->assertCount(1, Subscription::query()->get());
});

test('the provided email address must be valid', function (string $email) {
    $this->post(route('subscription.store'), [
        'email' => $email,
    ])
        ->assertRedirectToRoute('index')
        ->assertInvalid('email');

    $this->assertCount(0, Subscription::query()->get());
})->with([
    ['test.com'],
    ['invalid'],
    ['123'],
]);
