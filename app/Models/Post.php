<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'short_link',
        'password',
        'expiration_time',
        'view_limit',
        'hidden_until',
        // 'unlock_after',
        'unlock_price'
    ];

    // Optionally, you might want to cast dates if you're using them
    protected $casts = [
        'expiration_time' => 'datetime',
        'hidden_until' => 'datetime',
    ];
}
