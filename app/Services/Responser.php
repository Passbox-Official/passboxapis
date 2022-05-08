<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;

class Responser
{
    public function ok(string $message, $httpCode = Response::HTTP_OK, array $data = []): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'data' => empty($data) ? null : $data,
        ], $httpCode);
    }

    public function error(string $message, $httpCode = Response::HTTP_BAD_REQUEST, array $data = []): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'data' => empty($data) ? null : $data,
        ], $httpCode);
    }
}
