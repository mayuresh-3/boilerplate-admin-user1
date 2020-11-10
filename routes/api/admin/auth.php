<?php

use App\Http\Controllers\Admin\ForgotPasswordController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\ResetPasswordController;

Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.reset');

Route::post('login', [LoginController::class, 'login'])->name('login');

Route::post('logout', [LoginController::class, 'logout'])->name('logout');
