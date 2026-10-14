<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    protected $table = 'artists';
    
    protected $fillable = [
        'artist_name',
        'artist_bio',
        'artist_image'
    ];

    public function music()
    {
        return $this->hasMany(Music::class, 'music_artist_id');
    }

    public function albums()
    {
        return $this->hasMany(Album::class, 'album_artist_id');
    }

    public function videos()
    {
        return $this->hasMany(Video::class, 'video_artist_id');
    }
}