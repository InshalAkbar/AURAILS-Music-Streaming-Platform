<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Music;
use App\Models\Artist;
use App\Models\Album;
use App\Models\Video;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = trim($request->input('q', ''));

        $music = collect();
        $artists = collect();
        $albums = collect();
        $videos = collect();

        if ($query !== '') {
            $music = Music::with(['artist', 'album', 'genre'])
                ->where(function ($q) use ($query) {
                    $q->where('music_title', 'LIKE', "%{$query}%")
                      ->orWhere('music_description', 'LIKE', "%{$query}%")
                      ->orWhereHas('artist', function ($qa) use ($query) {
                          $qa->where('artist_name', 'LIKE', "%{$query}%");
                      })
                      ->orWhereHas('album', function ($qa) use ($query) {
                          $qa->where('album_name', 'LIKE', "%{$query}%");
                      });
                })
                ->latest()
                ->take(20)
                ->get();

            $artists = Artist::where('artist_name', 'LIKE', "%{$query}%")
                ->orWhere('artist_bio', 'LIKE', "%{$query}%")
                ->take(12)
                ->get();

            $albums = Album::with('artist')
                ->where(function ($q) use ($query) {
                    $q->where('album_name', 'LIKE', "%{$query}%")
                      ->orWhere('album_description', 'LIKE', "%{$query}%")
                      ->orWhereHas('artist', function ($qa) use ($query) {
                          $qa->where('artist_name', 'LIKE', "%{$query}%");
                      });
                })
                ->latest()
                ->take(12)
                ->get();

            $videos = Video::with(['artist', 'album'])
                ->where(function ($q) use ($query) {
                    $q->where('video_title', 'LIKE', "%{$query}%")
                      ->orWhere('video_description', 'LIKE', "%{$query}%")
                      ->orWhereHas('artist', function ($qa) use ($query) {
                          $qa->where('artist_name', 'LIKE', "%{$query}%");
                      });
                })
                ->latest()
                ->take(12)
                ->get();
        }

        $totalResults = $music->count() + $artists->count() + $albums->count() + $videos->count();

        return view('Frontend.search', compact(
            'query', 'music', 'artists', 'albums', 'videos', 'totalResults'
        ));
    }
}