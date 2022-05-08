<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSessionHistory extends Model
{
    use HasFactory;

    protected $table = 'user_session_history';

    public $timestamps = false;
}
