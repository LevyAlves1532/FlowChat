<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('/v1')->group(function () {
    Route::middleware('auth:api')->group(function () {
        Route::apiResource('/auth', AuthController::class);

        Route::post('/user/profile-pic', [UserController::class, 'changeProfilePic']);

        Route::put('/auth', [AuthController::class, 'update']);
        Route::put('/user', [UserController::class, 'update']);
        Route::put('/user/password', [UserController::class, 'changePassword']);

        Route::delete('/auth', [AuthController::class, 'destroy']);
    });

    Route::post('/auth', [AuthController::class, 'store']);
    Route::post('/user', [UserController::class, 'store']);
});
