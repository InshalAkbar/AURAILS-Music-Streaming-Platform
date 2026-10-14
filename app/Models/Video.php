<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'video_title',
        'video_artist_id',
        'video_album_id',
        'video_genre_id',
        'video_language_id',
        'video_year',
        'video_description',
        'video_file_path',
        'video_youtube_id',
        'video_image_path',
        'video_duration',
        'video_is_new',
    ];

    public function artist()
    {
        return $this->belongsTo(Artist::class, 'video_artist_id');
    }

    public function album()
    {
        return $this->belongsTo(Album::class, 'video_album_id');
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class, 'video_genre_id');
    }

    public function language()
    {
        return $this->belongsTo(Language::class, 'video_language_id');
    }
}