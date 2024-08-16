<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BannerAd extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'placement',
        'direct_link',
        'image',
        'mobile_image',
        'user_id',
    ];
}
