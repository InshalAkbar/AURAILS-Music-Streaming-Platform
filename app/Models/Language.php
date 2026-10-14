<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $table = 'languages';

    protected $fillable = [
        'language_name'
    ];

    public function music()
    {
        return $this->hasMany(Music::class, 'music_language_id');
    }

    public function videos()
    {
        return $this->hasMany(Video::class, 'video_language_id');
    }
}