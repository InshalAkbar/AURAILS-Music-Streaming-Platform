<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Artist;
use App\Models\Album;
use App\Models\Genre;
use App\Models\Language;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::with(['artist', 'album', 'genre', 'language'])->get();
        return view('Admin.videos.index', compact('videos'));
    }

    public function create()
    {
        $artists = Artist::all();
        $albums = Album::all();
        $genres = Genre::all();
        $languages = Language::all();
        return view('Admin.videos.create', compact('artists', 'albums', 'genres', 'languages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'video_title'       => 'required|string|max:255',
            'video_artist_id'   => 'required|exists:artists,id',
            'video_album_id'    => 'nullable|exists:albums,id',
            'video_genre_id'    => 'nullable|exists:genres,id',
            'video_language_id' => 'nullable|exists:languages,id',
            'video_year'        => 'nullable|string|max:4',
            'video_description' => 'nullable|string',
            'video_file_path'   => 'nullable|string|max:255',
            'video_youtube_id'  => 'nullable|string|max:20',
            'video_image_path'  => 'nullable|string|max:255',
            'video_duration'    => 'nullable|string|max:20',
            'video_is_new'      => 'nullable|in:yes,no',
        ]);

        Video::create($request->all());

        return redirect()->route('admin.videos.index')->with('success', 'Video added successfully!');
    }

    public function show($id)
    {
        $video = Video::with(['artist', 'album', 'genre', 'language'])->findOrFail($id);
        return view('Admin.videos.show', compact('video'));
    }

    public function edit($id)
    {
        $video = Video::findOrFail($id);
        $artists = Artist::all();
        $albums = Album::all();
        $genres = Genre::all();
        $languages = Language::all();
        return view('Admin.videos.edit', compact('video', 'artists', 'albums', 'genres', 'languages'));
    }

    public function update(Request $request, $id)
    {
        $video = Video::findOrFail($id);

        $request->validate([
            'video_title'       => 'required|string|max:255',
            'video_artist_id'   => 'required|exists:artists,id',
            'video_album_id'    => 'nullable|exists:albums,id',
            'video_genre_id'    => 'nullable|exists:genres,id',
            'video_language_id' => 'nullable|exists:languages,id',
            'video_year'        => 'nullable|string|max:4',
            'video_description' => 'nullable|string',
            'video_file_path'   => 'nullable|string|max:255',
            'video_youtube_id'  => 'nullable|string|max:20',
            'video_image_path'  => 'nullable|string|max:255',
            'video_duration'    => 'nullable|string|max:20',
            'video_is_new'      => 'nullable|in:yes,no',
        ]);

        $video->update($request->all());

        return redirect()->route('admin.videos.index')->with('success', 'Video updated successfully!');
    }

    public function destroy($id)
    {
        Video::findOrFail($id)->delete();
        return redirect()->route('admin.videos.index')->with('success', 'Video deleted successfully!');
    }
}