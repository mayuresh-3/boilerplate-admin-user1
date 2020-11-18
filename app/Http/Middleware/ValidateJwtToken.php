<?php

namespace App\Http\Middleware;

use App\Exceptions\NotFoundException;
use App\Exceptions\UnauthorizedException;
use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

/**
 * This middleware is utilized to validate the routes which are being used by
 * both type of users like accounts and guest users.
 * So we if bearer token is present then we are just validating the token
 * and returning the proper message.
 *
 * Class ValidateAccountAuth
 */
class ValidateJwtToken
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (! $request->bearerToken()) {
            return $next($request);
        }

        return $this->validateToken($request, $next);
    }

    private function validateToken($request, Closure $next)
    {
        try {
            if (! JWTAuth::parseToken()->authenticate()) {
                throw new NotFoundException('Unable to find the account');
            }
        } catch (TokenExpiredException $e) {
            throw new UnauthorizedException('Token has been expired');
        } catch (TokenInvalidException $e) {
            throw new UnauthorizedException('Token is not valid');
        } catch (JWTException $e) {
            throw new UnauthorizedException('Unable to parse the token');
        }

        return $next($request);
    }
}
