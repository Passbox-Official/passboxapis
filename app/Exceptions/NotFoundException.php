<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

class NotFoundException extends Exception
{
    public function render(): JsonResponse
    {
        return response()->json([
            'message' => $this->message,
            'httpCode' => Response::HTTP_NOT_FOUND,
        ], Response::HTTP_NOT_FOUND);
    }
}
