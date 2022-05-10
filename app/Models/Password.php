<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Password extends Model
{
    use HasFactory, SoftDeletes;

    public const IS_FAVOURITE = 1;
    public const NOT_FAVOURITE = 0;

    /**
     * Password report status
     *
     * Ex. Weak, strong, medium, common etc.
     */
    public const NOT_CHECKED = 0;
    public const WEAK = 1;
    public const MEDIUM = 2;
    public const COMMON = 3;
    public const STRONG = 4;

    protected $hidden = [
        'user_id',
        'deleted_at',
        'updated_at',
    ];

    protected $casts = [
        'created_at' => 'datetime:d M, Y',
        'is_favourite' => 'bool',
    ];

    protected function getLastUsedAttribute(): string|null
    {
        if (! is_null($this->attributes['last_used'])) {
            return Carbon::createFromDate($this->attributes['last_used'])
                ->diffForHumans();
        }
        return null;
    }
}
