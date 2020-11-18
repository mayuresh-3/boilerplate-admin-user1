<?php
use App\Http\Controllers\User\UserController;

Route::middleware('auth:users')->group(function () {
    Route::get('demo', [UserController::class, 'demo']);
});
