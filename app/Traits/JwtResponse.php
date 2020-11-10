<?php

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

trait JwtResponse
{
    /**
     * @param $token
     * @return JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * Carbon::SECONDS_PER_MINUTE,
        ], Response::HTTP_OK);
    }
}
