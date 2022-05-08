<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use App\Facades\Responser;

class MaxDeviceExceededException extends Exception
{
    public function render(): JsonResponse
    {
        return Responser::error($this->message, Response::HTTP_NOT_ACCEPTABLE);
    }
}
