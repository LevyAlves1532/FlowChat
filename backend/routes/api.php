<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('/v1')->middleware('throttle:100,2')->group(function () {
    Route::middleware('auth:api')->group(function () {
        Route::apiResource('/auth', AuthController::class);

        Route::get('/user', [UserController::class, 'index']);
        Route::get('/message/partners', [MessageController::class, 'getChatPartners']);
        Route::get('/message/{user}/chat', [MessageController::class, 'index']);

        Route::post('/user/profile-pic', [UserController::class, 'changeProfilePic']);
        Route::post('/message/{user}', [MessageController::class, 'store']);

        Route::put('/auth', [AuthController::class, 'update']);
        Route::put('/user', [UserController::class, 'update']);
        Route::put('/user/password', [UserController::class, 'changePassword']);

        Route::delete('/auth', [AuthController::class, 'destroy']);
    });

    Route::post('/auth', [AuthController::class, 'store']);
    Route::post('/user', [UserController::class, 'store']);
});
