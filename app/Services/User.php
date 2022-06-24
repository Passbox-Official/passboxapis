<?php

namespace App\Services;

use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Exceptions\InvalidPasswordException;
use App\Models\UserSessionHistory;
use App\Models\User as UserModel;
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

    /**
     * @throws NotFoundException
     */
    public function delete_device_by_id($device_id): bool
    {
        $history = UserSessionHistory::where('user_id', auth()->user()->id)
            ->where('id', $device_id)
            ->first();
        if (! $history) {
            throw new NotFoundException('Device id not found');
        }
        return $history->delete();
    }

    public function do_logout(string $token = ''): void
    {
        UserSessionHistory::where('token', $token)
            ->update([
                'logout_at' => now(),
            ]);
        auth()->user()
            ->currentAccessToken()
            ->delete();
    }

    public function change_password($data): void
    {
        $old_password = $data->validated('old_password');
        $new_password = $data->validated('new_password');

        if (! Hash::check($old_password, auth()->user()->getAuthPassword())) {
            throw new InvalidPasswordException('Old password mismatched');
        }
        UserModel::find(auth()->user()->id)
            ->update([
                'password' => Hash::make($new_password),
            ]);
    }

    public function profile()
    {
        return auth()->user();
    }

    public function update($payload)
    {
        return auth()->user()->update($payload);
    }
}
