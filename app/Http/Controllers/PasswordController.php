<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Facades\Responser;
use App\Facades\Password;
use App\Http\Requests\Password\PasswordStoreRequest;

class PasswordController extends Controller
{
    public function store(PasswordStoreRequest $request): JsonResponse
    {
        Password::store($request->validated());
        return Responser::ok('Password added successfully!', Response::HTTP_CREATED);
    }

    public function index()
    {
        $data = Password::index();
        return Responser::ok('Password index', Response::HTTP_OK, $data);
    }
}
