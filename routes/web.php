<?php

use App\Http\Controllers\SubscribeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/request', function (Request $request) {
    return dd($request->all());
});

Route::prefix('subscribe')->group(function () {
    Route::get('/plans', [SubscribeController::class, 'showPlans']);
});


