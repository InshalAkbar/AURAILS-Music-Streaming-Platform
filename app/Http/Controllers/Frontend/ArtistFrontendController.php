<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Artist;
use App\Models\Music;
use Illuminate\Http\Request;

class ArtistFrontendController extends Controller
{
    public function index()
    {
        $artists = Artist::withCount('music')->get();
        return view('Frontend.artists', compact('artists'));
    }

    public function show($id)
    {
        $artist = Artist::findOrFail($id);
        $music = Music::where('music_artist_id', $id)->with('artist')->get();
        return view('Frontend.artist_show', compact('artist', 'music'));
    }
}