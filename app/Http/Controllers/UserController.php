<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Facades\User;
Use App\Facades\Responser;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function logged_in_devices(Request $request)
    {
        $active_devices = auth()->user()->active_devices->map(function ($active_device) {
            return [
                'id' => $active_device->id,
                'login_at' => $active_device->login_at,
                'token' => $active_device->token,
                'platform' => $active_device->platform,
                'device_info' => $active_device->device_info,
                'device_id' => $active_device->device_id,
            ];
        });
        return Responser::ok('Active devices', Response::HTTP_OK, $active_devices);
    }
}