<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\SubscriberController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('/subscribers', SubscriberController::class);

Route::apiResource('/newsletters', NewsletterController::class);

Route::apiResource('/campaigns', CampaignController::class);

Route::post('/logout', [AuthController::class, 'logout']);

Route::post('/login', [AuthController::class, 'login']);

Route::get('/me', [AuthController::class, 'me']);

Route::post('signup', [AuthController::class, 'signup']);