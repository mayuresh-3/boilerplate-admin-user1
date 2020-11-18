<?php

namespace App\Exceptions;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class ValidationException extends HttpResponseException
{
    public function __construct($message = 'Unable to process the given entity')
    {
        parent::__construct(response([
            'status' => 'fail',
            'message' => $message,
        ], Response::HTTP_UNPROCESSABLE_ENTITY));
    }
}
