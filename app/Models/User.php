<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticable
{
    use HasFactory, HasApiTokens, HasRoles;

    // Account statuses
    public const INACTIVE = 0;
    public const BLOCKED = 1;
    public const ACTIVE = 2;

    // Gender
    public const MALE = 'male';
    public const FEMALE = 'female';
    public const UNSPECIFIED = 'unspecified';

    protected $hidden = [
        'password',
    ];

    public function active_devices()
    {
        return $this->hasMany(UserSessionHistory::class, 'user_id')
            ->where('logout_at', null);
    }
}
