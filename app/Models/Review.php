<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'reviews';
    
    protected $fillable = [
        'review_user_id',
        'review_media_type',
        'review_media_id',
        'review_rating',
        'review_text'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'review_user_id');
    }
}