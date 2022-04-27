<?php
use App\Http\Controllers\User\InfluencerController;

Route::middleware('auth:users')->group(function () {
    Route::post('/influencers', [InfluencerController::class, 'store']);
});
Route::get('/tamayou_influencers/{id}', [InfluencerController::class, 'getTamayouInfluencer']);
Route::post('/tamayou_influencers', [InfluencerController::class, 'storeInfluencerMap']);

