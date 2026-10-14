<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Music;
use App\Models\Artist;
use App\Models\Album;
use App\Models\Video;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $latestMusic = Music::with(['artist', 'album', 'genre'])
            ->latest()
            ->take(8)
            ->get();
            
        $topArtists = Artist::withCount('music')
            ->orderBy('music_count', 'desc')
            ->take(6)
            ->get();
            
        $recentAlbums = Album::with('artist')
            ->latest()
            ->take(6)
            ->get();
            
        $latestVideos = Video::with('artist')
            ->latest()
            ->take(4)
            ->get();

        // Get user's favorite album IDs
        $favoriteAlbumIds = [];
        if (Auth::check()) {
            $favoriteAlbumIds = Favorite::where('user_id', Auth::id())
                ->pluck('album_id')
                ->toArray();
        }

        return view('Frontend.home', compact(
            'latestMusic', 
            'topArtists', 
            'recentAlbums', 
            'latestVideos',
            'favoriteAlbumIds'
        ));
    }
}