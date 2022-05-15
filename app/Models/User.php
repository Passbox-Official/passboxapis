<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
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

    public function active_devices(): HasMany
    {
        return $this->hasMany(UserSessionHistory::class, 'user_id')
            ->whereNull('logout_at')
            ->whereNull('deleted_at')
            ->orderByDesc('id');
    }

    static function last_token($user_id): string
    {
        return UserSessionHistory::query()
            ->where('id', $user_id)
            ->whereNull('logout_at')
            ->whereNull('deleted_at')
            ->orderByDesc('id')
            ->first()
            ->token;
    }

    public function passwords(): HasMany
    {
        return $this->hasMany(Password::class, 'user_id')
            ->orderBy('id', 'DESC');
    }

    public function url_exists(string $url = ''): bool
    {
        $site = $this->passwords()
            ->where('url', $url)
            ->first();
        if ($site) {
            return true;
        }
        return false;
    }

    public function password_access_history(): HasMany
    {
        return $this->hasMany(PasswordAccessHistory::class, 'user_id');
    }
}
