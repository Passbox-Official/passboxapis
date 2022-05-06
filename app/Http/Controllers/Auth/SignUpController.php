<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SignUpRequest;
use Illuminate\Http\Request;
use App\Facades\User;

class SignUpController extends Controller
{
    public function create_account(SignUpRequest $request)
    {
        try {
            return User::create($request);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
}
