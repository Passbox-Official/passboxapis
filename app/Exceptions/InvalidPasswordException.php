<?php

namespace App\Exceptions;

use App\Facades\Responser;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class InvalidPasswordException extends Exception
{
    public function render(): JsonResponse
    {
        return Responser::error($this->message, Response::HTTP_NOT_ACCEPTABLE);
    }
}
