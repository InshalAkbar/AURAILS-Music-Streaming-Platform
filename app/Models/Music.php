<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Music extends Model
{
    use HasFactory;

    protected $fillable = [
        'music_title',
        'music_artist_id',
        'music_album_id',
        'music_genre_id',
        'music_language_id',
        'music_year',
        'music_description',
        'music_file_path',
        'music_youtube_id',
        'music_image_path',
        'music_is_new',
    ];

    public function artist()
    {
        return $this->belongsTo(Artist::class, 'music_artist_id');
    }

    public function album()
    {
        return $this->belongsTo(Album::class, 'music_album_id');
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class, 'music_genre_id');
    }

    public function language()
    {
        return $this->belongsTo(Language::class, 'music_language_id');
    }
}