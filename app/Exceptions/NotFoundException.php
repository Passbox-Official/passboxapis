<?php

namespace App\Exceptions;

use App\Facades\Responser;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

class NotFoundException extends Exception
{
    public function render(): JsonResponse
    {
        return Responser::error($this->message, Response::HTTP_NOT_FOUND);
    }
}
