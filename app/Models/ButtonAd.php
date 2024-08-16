<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ButtonAd extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'placement',
        'direct_link',
        'user_id',
    ];
}
