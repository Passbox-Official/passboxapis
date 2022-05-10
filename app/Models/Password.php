<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
}
