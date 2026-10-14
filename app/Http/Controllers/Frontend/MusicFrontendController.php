<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Music;
use App\Models\Genre;
use Illuminate\Http\Request;

class MusicFrontendController extends Controller
{
    public function index(Request $request)
    {
        $query = Music::with(['artist', 'album', 'genre', 'language']);

        if ($request->filled('genre')) {
            $query->where('music_genre_id', $request->genre);
        }

        if ($request->filled('year')) {
            $query->where('music_year', $request->year);
        }

        if ($request->filled('artist')) {
            $query->where('music_artist_id', $request->artist);
        }

        $sort = $request->input('sort', 'latest');
        switch ($sort) {
            case 'oldest': $query->oldest(); break;
            case 'az':     $query->orderBy('music_title', 'asc'); break;
            case 'za':     $query->orderBy('music_title', 'desc'); break;
            default:       $query->latest(); break;
        }

        $music = $query->paginate(12)->withQueryString();

        $genres = Genre::orderBy('genre_name')->get();
        $years  = Music::whereNotNull('music_year')
            ->distinct()
            ->orderBy('music_year', 'desc')
            ->pluck('music_year');

        return view('Frontend.music', compact('music', 'genres', 'years'));
    }

    public function show($id)
    {
        $item = Music::with(['artist', 'album', 'genre', 'language'])->findOrFail($id);
        return view('Frontend.music_show', compact('item'));
    }
}