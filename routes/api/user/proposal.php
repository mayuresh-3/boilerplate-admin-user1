<?php
use App\Http\Controllers\Proposal\ProposalController;

Route::middleware('auth:Proposals')->group(function () {
    Route::get('/list', [ProposalController::class, 'index']);
    Route::get('/show/{id}', [ProposalController::class, 'show']);
    Route::get('/test', [ProposalController::class, 'test']);
    Route::delete('/destroy/{id}', [ProposalController::class, 'destroy']);
    Route::post('/create', [ProposalController::class, 'store']);
});
