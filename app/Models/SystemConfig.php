<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemConfig extends Model
{
    use HasFactory;

    public const BEARER_TOKEN_NAME = 'bearer-token';
    public const SUDO_PASSWORD = 'sudo-password';
    public const MAX_DEVICE_LOGIN = 'max-device-login';
    public const MAX_DEVICE_LOGIN_DEFAULT_COUNT = 3;
}
