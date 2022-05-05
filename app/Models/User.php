<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\RoleUser;

class User extends Authenticable
{
    use HasFactory, HasApiTokens;

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
        'created_at',
        'updated_at',
        'id',
    ];

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'role_user')
            ->withTimestamps();
    }

    public function system_configs(): HasMany
    {
        return $this->hasMany(SystemConfig::class);
    }
}
