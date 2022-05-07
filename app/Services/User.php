<?php

namespace App\Services;

use Illuminate\Support\Facades\Hash;
use App\Models\User as UserModel;
use Spatie\Permission\Models\Role;

class User
{
    public function create($request)
    {
        $data = [
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];
        $admin = Role::where('name' , 'admin')->first();
        return UserModel::firstOrCreate($data)->syncRoles($admin);
    }
}
