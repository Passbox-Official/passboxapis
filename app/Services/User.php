<?php

namespace App\Services;

use App\Models\UserSessionHistory;
use Illuminate\Support\Facades\Hash;
use App\Models\User as UserModel;
use Spatie\Permission\Models\Role;
use App\Exceptions\NotFoundException;

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

    public function by_email(string $email = '')
    {
        return UserModel::where('email', $email)->first();
    }

    public function create_session_history(array $data = [])
    {
        return UserSessionHistory::create($data);
    }

    public function total_active_devices(string $email = '')
    {
        $user = UserModel::where('email', $email)->first();
        if (! $user) {
            throw new NotFoundException('Invalid email');
        }
        return $user->active_devices;
    }
}
