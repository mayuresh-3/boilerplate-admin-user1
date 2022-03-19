<?php
use App\Http\Controllers\User\UserController;

Route::middleware('auth:users')->group(function () {
    Route::get('/list', [UserController::class, 'index']);
    Route::get('/show/{id}', [UserController::class, 'show']);
    Route::get('/test', [UserController::class, 'test']);
    Route::delete('/destroy/{id}', [UserController::class, 'destroy']);
});
