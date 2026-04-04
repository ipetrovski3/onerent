<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoogleReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'google_hash',
        'author_name',
        'rating',
        'text',
        'profile_photo_url',
        'review_time',
    ];

    protected $casts = [
        'review_time' => 'datetime',
    ];
}
