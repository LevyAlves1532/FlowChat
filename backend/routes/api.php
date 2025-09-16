<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('/v1')->group(function () {
    Route::middleware('auth:api')->group(function () {
        Route::apiResource('/auth', AuthController::class);
        Route::apiResource('/user', UserController::class);

        Route::put('/auth', [AuthController::class, 'update']);

        Route::delete('/auth', [AuthController::class, 'destroy']);
    });

    Route::post('/auth', [AuthController::class, 'store']);
    Route::post('/user', [UserController::class, 'store']);
});
