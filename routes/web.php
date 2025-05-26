<?php

use App\Http\Controllers\SubscribeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
  return view('welcome');
});

Route::get('/home', function () {
  return view('home');
})->middleware(['auth', 'check.device.limit'])->name('home');

Route::get('/subscribe/plans', [SubscribeController::class, 'showPlans'])->name('subscribe.plans');

Route::get('/subscribe/plan/{plan}', [SubscribeController::class, 'checkoutPlans'])->name('subscribe.checkout');

Route::post('/subscribe/checkout', [SubscribeController::class, 'prosessCheckout'])->name('subscribe.process');

Route::get('/subscribe/success', [SubscribeController::class, 'showSuccess'])->name('subscribe.success');

Route::post('/logout', function (Request $request) {
  return app(\Laravel\Fortify\Http\Controllers\AuthenticatedSessionController::class)->destroy($request);
})->name('logout')->middleware(['auth', 'logout.device']);
