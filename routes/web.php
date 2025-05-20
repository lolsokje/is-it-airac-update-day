<?php

use App\Http\Controllers\Auth\Discord\DiscordAuthCallbackController;
use App\Http\Controllers\Auth\Discord\DiscordAuthRedirectController;
use App\Http\Controllers\Connections\ConnectionIndexController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\Profile\Discord\DestroyDiscordWebhookController;
use App\Http\Controllers\Profile\Discord\StoreDiscordWebhookController;
use App\Http\Controllers\Profile\Discord\UpdateDiscordWebhookController;
use App\Http\Controllers\Profile\ProfileIndexController;
use App\Http\Controllers\ShowUnsubscribeFormController;
use App\Http\Controllers\SubscribeController;
use App\Http\Controllers\UnsubscribeController;
use App\Http\Controllers\UnsubscribeWithTokenController;
use Illuminate\Support\Facades\Route;

Route::get('/', IndexController::class)->name('index');

Route::get('/connections', ConnectionIndexController::class)->name('connections.index');

Route::post('/subscribe', SubscribeController::class)->name('subscription.store');
Route::delete('/unsubscribe', UnsubscribeController::class)->name('subscription.destroy');
Route::get('/unsubscribe/token/{token?}', UnsubscribeWithTokenController::class)->name('subscription.destroy.token');

Route::get('/unsubscribe', ShowUnsubscribeFormController::class)->name('unsubscribe.show');

Route::group(['prefix' => '/auth', 'as' => 'auth.'], function () {
    Route::get('/discord/redirect', DiscordAuthRedirectController::class)->name('discord.redirect');
    Route::get('/discord/callback', DiscordAuthCallbackController::class)->name('discord.callback');
});

Route::group(['prefix' => '/profile', 'as' => 'profile.', 'middleware' => 'auth'], function () {
    Route::get('/', ProfileIndexController::class)->name('index');

    Route::post('/discord/webhook', StoreDiscordWebhookController::class)->name('discord.webhooks.store');
    Route::put('/discord/webhook/{webhook}', UpdateDiscordWebhookController::class)->name('discord.webhooks.update');
    Route::delete('discord/webhook/{webhook}', DestroyDiscordWebhookController::class)->name('discord.webhooks.destroy');
});
