<?php

namespace App\Exceptions;

use App\Facades\Responser;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class UrlAlreadyExistsException extends Exception
{
    public function render(): JsonResponse
    {
        return Responser::error('URL already exists', Response::HTTP_NOT_ACCEPTABLE);
    }
}
