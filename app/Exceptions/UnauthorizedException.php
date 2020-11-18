<?php

namespace App\Exceptions;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class UnauthorizedException extends HttpResponseException
{
    public function __construct($message = 'You did not sign in correctly or your account is temporarily disabled')
    {
        parent::__construct(response([
            'status' => 'fail',
            'message' => $message,
        ], Response::HTTP_UNAUTHORIZED));
    }
}
