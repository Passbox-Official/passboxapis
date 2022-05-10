<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
Use App\Facades\Responser;
use App\Facades\User;
use App\Http\Requests\Auth\ChangePasswordRequest;

class UserController extends Controller
{
    public function logged_in_devices(Request $request): JsonResponse
    {
        $active_devices = auth()->user()->active_devices->map(function ($active_device) {
            return [
                'id' => $active_device->id,
                'login_at' => $active_device->login_at,
                'token' => Str::limit($active_device->token, 10, '***'),
                'platform' => $active_device->platform,
                'device_name' => $active_device->device_name,
                'device_info' => $active_device->device_info,
                'device_id' => $active_device->device_id,
            ];
        });
        return Responser::ok('Active devices', Response::HTTP_OK, $active_devices);
    }

    public function delete_device(Request $request, $device_id): JsonResponse
    {
        User::delete_device_by_id($device_id);
        return Responser::ok('Device deleted successfully!');
    }

    public function do_change_password(ChangePasswordRequest $request): JsonResponse
    {
        User::change_password($request);
        return Responser::ok('Password updated successfully!');
    }
}
