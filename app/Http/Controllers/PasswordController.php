<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Facades\Responser;
use App\Facades\Password;
use App\Http\Requests\Password\PasswordStoreRequest;
use App\Http\Requests\Password\PasswordFindRequest;
use App\Http\Resources\PasswordResource;

class PasswordController extends Controller
{
    public function store(PasswordStoreRequest $request): JsonResponse
    {
        Password::store($request->validated());
        return Responser::ok('Password added successfully!', Response::HTTP_CREATED);
    }

    public function index(): JsonResponse
    {
        $data = Password::index();
        return Responser::ok('Password index', Response::HTTP_OK, $data);
    }

    public function destroy(Request $request, $id)
    {
        Password::destroy($id);
        return Responser::ok('Record deleted');
    }

    public function find(PasswordFindRequest $request): JsonResponse
    {
        $data = Password::find($request->validated('url'));
        return new PasswordResource($data);
    }
}
