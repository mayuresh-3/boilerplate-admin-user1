<?php
use App\Http\Controllers\User\CampaignController;

Route::middleware('auth:users')->group(function () {
    Route::get('/campaigns', [CampaignController::class, 'index']);
    Route::get('/campaigns/{id}', [CampaignController::class, 'show']);
    Route::delete('/campaigns/{id}', [CampaignController::class, 'destroy']);
    Route::post('/campaigns', [CampaignController::class, 'store']);
    Route::put('/campaigns/{id}', [CampaignController::class, 'update']);
});
