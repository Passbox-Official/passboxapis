<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SignUpRequest;
use Illuminate\Http\Request;
use App\Facades\User;
use App\Http\Resources\UserResource;

class SignUpController extends Controller
{
    public function create_account(SignUpRequest $request): UserResource
    {
        return new UserResource(
            User::create($request), 'Account created successfully'
        );
    }
}
