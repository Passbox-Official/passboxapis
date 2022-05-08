<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemConfig extends Model
{
    use HasFactory;

    public const BEARER_TOKEN_NAME = 'bearer-token';
    public const MASTER_PASSWORD = 'super-password';
}
