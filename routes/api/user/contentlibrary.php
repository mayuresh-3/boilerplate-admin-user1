<?php
use App\Http\Controllers\User\ContentlibraryController;

Route::middleware('auth:users')->group(function () {
    Route::get('/contentlib', [ContentlibraryController::class, 'index']);
    Route::get('/contentlib/{id}', [ContentlibraryController::class, 'show']);
    Route::delete('/contentlib/{id}', [ContentlibraryController::class, 'destroy']);
    Route::post('/contentlib', [ContentlibraryController::class, 'store']);
    Route::put('/contentlib/{id}', [ContentlibraryController::class, 'update']);
});
