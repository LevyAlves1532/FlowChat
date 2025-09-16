<?php

use App\Http\Controllers\UserController;
use App\Mail\WelcomeMail;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/user/{user}/confirm-account', [UserController::class, 'confirmAccount'])
    ->name('user.confirm-account');
