<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserSessionHistory extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'user_session_history';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
