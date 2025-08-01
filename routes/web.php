<?php

use App\Http\Controllers\MovieController;
use App\Http\Controllers\SubscribeController;
use Illuminate\Auth\Events\Authenticated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/request', function (Request $request) {
    return dd($request->all());
});

Route::get('/home', [MovieController::class, 'index'])->middleware('auth', 'check.device.limit')->name('movies.index');
Route::get('/movies/{movie:slug}', [MovieController::class, 'show'])->middleware('auth', 'check.device.limit')->name('movies.show');

Route::post('/logout', function(Request $request) {
    return app(AuthenticatedSessionController::class)->destroy($request);
})->middleware('auth', 'logout.device')->name('logout');

Route::prefix('subscribe')->group(function () {
    Route::get('/plans', [SubscribeController::class, 'showPlans'])->name('subscribe.plans');
    Route::get('/plans/{plan}', [SubscribeController::class, 'checkoutPlan'])->name('subscribe.checkout');
    Route::post('/plans/checkout', [SubscribeController::class, 'processCheckout'])->name('subscribe.process');
    Route::get('/success', [SubscribeController::class, 'showSuccess'])->name('subscribe.success');
});


