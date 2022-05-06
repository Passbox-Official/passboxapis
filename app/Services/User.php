<?php

namespace App\Services;

use App\Models\User as UserModel;
use Illuminate\Support\Facades\Hash;

class User
{
    public function create($request)
    {
        $data = [
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];
        return UserModel::firstOrCreate($data);
    }
}
