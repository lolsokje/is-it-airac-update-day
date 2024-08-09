<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\ShowUnsubscribeFormController;
use App\Http\Controllers\SubscribeController;
use App\Http\Controllers\UnsubscribeController;
use Illuminate\Support\Facades\Route;

Route::get('/', IndexController::class)->name('index');

Route::post('/subscribe', SubscribeController::class)->name('subscription.store');
Route::delete('/unsubscribe', UnsubscribeController::class)->name('subscription.destroy');

Route::get('/unsubscribe', ShowUnsubscribeFormController::class)->name('unsubscribe.show');
