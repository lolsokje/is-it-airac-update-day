<?php

use App\Models\Subscription;
use App\Support\UnsubscribeTokenGenerator;

it('can create tokens from a subscription', function () {
    $subscription = Subscription::factory()->create();

    $token = UnsubscribeTokenGenerator::createToken($subscription);

    $this->assertIsString($token);
    $this->assertEquals($subscription->email, decrypt($token));
});

it('returns null when no valid token is provided', function () {
    $this->assertNull(UnsubscribeTokenGenerator::findSubscription());
});

it('returns null when no subscription can be found', function () {
    $this->assertNull(UnsubscribeTokenGenerator::findSubscription(encrypt('test@example.com')));
});

it('returns the correct subscription when a valid token has been provided', function () {
    Subscription::factory(2)->create();
    $subscription = Subscription::factory()->create();

    $token = UnsubscribeTokenGenerator::createToken($subscription);

    $this->assertEquals($subscription->id, UnsubscribeTokenGenerator::findSubscription($token)->id);
});
