<?php
use App\Http\Controllers\User\ProposalController;

Route::middleware('auth:users')->group(function () {
    Route::get('/proposals', [ProposalController::class, 'index']);
    Route::get('/proposals/{id}', [ProposalController::class, 'show']);
    Route::delete('/proposals/{id}', [ProposalController::class, 'destroy']);
    Route::post('/proposals', [ProposalController::class, 'store']);
});
