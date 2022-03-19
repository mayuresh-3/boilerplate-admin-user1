<?php

use App\Http\Controllers\User\ForgotPasswordController;
use App\Http\Controllers\User\LoginController;
use App\Http\Controllers\User\ResetPasswordController;
use App\Http\Controllers\User\UserController;

Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.reset');

Route::post('login', [LoginController::class, 'login'])->name('login');

Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::post('/register', [UserController::class, 'store']);
