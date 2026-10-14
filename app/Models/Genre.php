<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $table = 'genres';
    
    protected $fillable = [
        'genre_name'
    ];

    public function music()
    {
        return $this->hasMany(Music::class, 'music_genre_id');
    }

    public function videos()
    {
        return $this->hasMany(Video::class, 'video_genre_id');
    }
}