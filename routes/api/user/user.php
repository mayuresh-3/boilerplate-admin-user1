<?php
use App\Http\Controllers\User\UserController;

Route::middleware('auth:users')->group(function () {
    Route::get('/list', [UserController::class, 'index']);
    Route::get('/test', [UserController::class, 'test']);
    Route::post('/register', [UserController::class, 'store']);
});
