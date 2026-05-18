<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TrackController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);

// Protected routes, requires a valid token
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/tracks', [TrackController::class, 'index']);
});
