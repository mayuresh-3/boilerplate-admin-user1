<?php
use App\Http\Controllers\User\FileController;

Route::post('/file/uploads', [FileController::class, 'store']);
