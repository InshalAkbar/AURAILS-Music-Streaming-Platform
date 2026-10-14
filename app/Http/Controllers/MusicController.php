<?php

namespace App\Http\Controllers;

use App\Models\Music;
use App\Models\Artist;
use App\Models\Album;
use App\Models\Genre;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MusicController extends Controller
{
    public function index()
    {
        $music = Music::with(['artist', 'album', 'genre', 'language'])->get();
        return view('Admin.music.index', compact('music'));
    }

    public function create()
    {
        $artists = Artist::all();
        $albums = Album::all();
        $genres = Genre::all();
        $languages = Language::all();
        return view('Admin.music.create', compact('artists', 'albums', 'genres', 'languages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'music_title'       => 'required|string|max:255',
            'music_artist_id'   => 'required|exists:artists,id',
            'music_album_id'    => 'nullable|exists:albums,id',
            'music_genre_id'    => 'nullable|exists:genres,id',
            'music_language_id' => 'nullable|exists:languages,id',
            'music_year'        => 'nullable|string|max:4',
            'music_description' => 'nullable|string',
            'music_file_path'   => 'nullable|string|max:255',
            'music_audio_file'  => 'nullable|file|mimes:mp3,wav,ogg,m4a|max:20480',
            'music_youtube_id'  => 'nullable|string|max:20',
            'music_image_path'  => 'nullable|string|max:255',
            'music_is_new'      => 'nullable|in:yes,no',
        ]);

        $data = $request->except('music_audio_file');

        if ($request->hasFile('music_audio_file')) {
            $path = $request->file('music_audio_file')->store('music/audio', 'public');
            $data['music_file_path'] = $path;
        }

        Music::create($data);

        return redirect()->route('admin.music.index')->with('success', 'Music added successfully!');
    }

    public function show($id)
    {
        $music = Music::with(['artist', 'album', 'genre', 'language'])->findOrFail($id);
        return view('Admin.music.show', compact('music'));
    }

    public function edit($id)
    {
        $music = Music::findOrFail($id);
        $artists = Artist::all();
        $albums = Album::all();
        $genres = Genre::all();
        $languages = Language::all();
        return view('Admin.music.edit', compact('music', 'artists', 'albums', 'genres', 'languages'));
    }

    public function update(Request $request, $id)
    {
        $music = Music::findOrFail($id);

        $request->validate([
            'music_title'       => 'required|string|max:255',
            'music_artist_id'   => 'required|exists:artists,id',
            'music_album_id'    => 'nullable|exists:albums,id',
            'music_genre_id'    => 'nullable|exists:genres,id',
            'music_language_id' => 'nullable|exists:languages,id',
            'music_year'        => 'nullable|string|max:4',
            'music_description' => 'nullable|string',
            'music_file_path'   => 'nullable|string|max:255',
            'music_audio_file'  => 'nullable|file|mimes:mp3,wav,ogg,m4a|max:20480',
            'music_youtube_id'  => 'nullable|string|max:20',
            'music_image_path'  => 'nullable|string|max:255',
            'music_is_new'      => 'nullable|in:yes,no',
        ]);

        $data = $request->except('music_audio_file');

        if ($request->hasFile('music_audio_file')) {
            if ($music->music_file_path && Storage::disk('public')->exists($music->music_file_path)) {
                Storage::disk('public')->delete($music->music_file_path);
            }
            $path = $request->file('music_audio_file')->store('music/audio', 'public');
            $data['music_file_path'] = $path;
        }

        $music->update($data);

        return redirect()->route('admin.music.index')->with('success', 'Music updated successfully!');
    }

    public function destroy($id)
    {
        $music = Music::findOrFail($id);
        if ($music->music_file_path && Storage::disk('public')->exists($music->music_file_path)) {
            Storage::disk('public')->delete($music->music_file_path);
        }
        $music->delete();
        return redirect()->route('admin.music.index')->with('success', 'Music deleted successfully!');
    }
}