<?php

use App\Modules\Auth\Controllers\AuthController;
use App\Modules\Users\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {

    // ── Public routes ──────────────────────────────────────────────────────
    Route::prefix('auth')->group(function () {
        Route::post('login', [AuthController::class, 'login']);
    });

    // ── Authenticated routes ───────────────────────────────────────────────
    Route::middleware('auth:sanctum')->group(function () {

        // Auth
        Route::prefix('auth')->group(function () {
            Route::post('logout', [AuthController::class, 'logout']);
            Route::get('me', [AuthController::class, 'me']);
        });

        // Users — admin only
        Route::middleware('role:admin')
            ->apiResource('users', UserController::class);
    });
});
