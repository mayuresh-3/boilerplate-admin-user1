<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\AuthController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

    require __DIR__ . '/auth.php';

// User routes
require __DIR__ . '/user.php';


// Proposal routes
require __DIR__ . '/proposal.php';

// Campaign routes
require __DIR__ . '/campaign.php';

// File upload
require __DIR__ . '/fileUpload.php';

// content library
require __DIR__ . '/contentlibrary.php';

//product
require __DIR__ . '/product.php';

require __DIR__ . '/influencer.php';


Route::get('/login/{provider}', [AuthController::class,'redirectToProvider']);
Route::get('/login/{provider}/callback', [AuthController::class,'handleProviderCallback']);

require __DIR__ . '/mediatype.php';

