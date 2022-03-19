<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\JwtResponse;
use App\Transformers\UserTransformer;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class LoginController extends Controller
{
    use JwtResponse;

    /**
     * @return JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
        }

        $user = auth()->user();
        $response = fractal()
            ->item($user, new UserTransformer(), 'data')->toArray();
        $response['access_token'] = $token;
        $response['token_type'] = 'bearer';
        $response['expires_in'] = auth()->factory()->getTTL() * Carbon::SECONDS_PER_MINUTE;
        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * @return JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json([
            'message' => 'Successfully logged out',
        ], Response::HTTP_OK);
    }
}
