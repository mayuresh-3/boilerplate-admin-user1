<?php
use App\Http\Controllers\User\InfluencerController;

Route::middleware('auth:users')->group(function () {
    Route::post('/influencers', [InfluencerController::class, 'store']);
});
