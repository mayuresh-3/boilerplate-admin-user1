<?php
use App\Http\Controllers\User\MediatypeController;

Route::middleware('auth:users')->group(function () {
    Route::get('/mediatypes', [MediatypeController::class, 'index']);
    Route::get('/mediatypes/{id}', [MediatypeController::class, 'show']);
    Route::delete('/mediatypes/{id}', [MediatypeController::class, 'destroy']);
    Route::post('/mediatypes', [MediatypeController::class, 'store']);
    Route::put('/mediatypes/{id}', [MediatypeController::class, 'update']);
});
