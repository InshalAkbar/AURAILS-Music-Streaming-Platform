<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Artist;
use Illuminate\Http\Request;

class AlbumFrontendController extends Controller
{
    public function index(Request $request)
    {
        $query = Album::with('artist');

        if ($request->filled('artist')) {
            $query->where('album_artist_id', $request->artist);
        }

        if ($request->filled('year')) {
            $query->where('album_release_year', $request->year);
        }

        $sort = $request->input('sort', 'latest');
        switch ($sort) {
            case 'oldest': $query->oldest(); break;
            case 'az':     $query->orderBy('album_name', 'asc'); break;
            case 'za':     $query->orderBy('album_name', 'desc'); break;
            case 'year':   $query->orderBy('album_release_year', 'desc'); break;
            default:       $query->latest(); break;
        }

        $albums = $query->paginate(12)->withQueryString();

        $artists = Artist::orderBy('artist_name')->get();
        $years   = Album::whereNotNull('album_release_year')
            ->distinct()
            ->orderBy('album_release_year', 'desc')
            ->pluck('album_release_year');

        return view('Frontend.albums', compact('albums', 'artists', 'years'));
    }

    public function show($id)
    {
        $album = Album::with('artist')->findOrFail($id);
        $music = Music::where('music_album_id', $id)->with('artist')->get();
        return view('Frontend.album_show', compact('album', 'music'));
    }
}