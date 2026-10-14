<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Video;
use App\Models\Genre;
use App\Models\Artist;
use Illuminate\Http\Request;

class VideoFrontendController extends Controller
{
    public function index(Request $request)
    {
        $query = Video::with(['artist', 'album', 'genre', 'language']);

        if ($request->filled('genre')) {
            $query->where('video_genre_id', $request->genre);
        }

        if ($request->filled('year')) {
            $query->where('video_year', $request->year);
        }

        if ($request->filled('artist')) {
            $query->where('video_artist_id', $request->artist);
        }

        $sort = $request->input('sort', 'latest');
        switch ($sort) {
            case 'oldest': $query->oldest(); break;
            case 'az':     $query->orderBy('video_title', 'asc'); break;
            case 'za':     $query->orderBy('video_title', 'desc'); break;
            default:       $query->latest(); break;
        }

        $videos = $query->paginate(12)->withQueryString();

        $genres  = Genre::orderBy('genre_name')->get();
        $artists = Artist::orderBy('artist_name')->get();
        $years   = Video::whereNotNull('video_year')
            ->distinct()
            ->orderBy('video_year', 'desc')
            ->pluck('video_year');

        return view('Frontend.videos', compact('videos', 'genres', 'artists', 'years'));
    }

    public function show($id)
    {
        $item = Video::with(['artist', 'album', 'genre', 'language'])->findOrFail($id);
        return view('Frontend.video_show', compact('item'));
    }
}