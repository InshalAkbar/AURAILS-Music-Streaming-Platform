<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    protected $fillable = [
        'album_name',
        'album_artist_id',
        'album_release_year',
        'album_cover_image',
        'album_description',
    ];

    public function artist()
    {
        return $this->belongsTo(Artist::class, 'album_artist_id');
    }

    public function music()
    {
        return $this->hasMany(Music::class, 'music_album_id');
    }

    public function videos()
    {
        return $this->hasMany(Video::class, 'video_album_id');
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class, 'album_id');
    }
}