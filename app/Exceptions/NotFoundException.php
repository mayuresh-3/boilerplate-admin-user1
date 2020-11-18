<?php

namespace App\Exceptions;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class NotFoundException extends HttpResponseException
{
    public function __construct($message = 'Resource could not be found.')
    {
        parent::__construct(response([
            'status' => 'fail',
            'message' => $message,
        ], Response::HTTP_NOT_FOUND));
    }
}
