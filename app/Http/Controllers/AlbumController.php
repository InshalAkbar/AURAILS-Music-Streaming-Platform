<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Artist;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    public function index()
    {
        $albums = Album::with('artist')->get();
        return view('Admin.albums.index', compact('albums'));
    }

    public function create()
    {
        $artists = Artist::all();
        return view('Admin.albums.create', compact('artists'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'album_name' => 'required|string|max:255',
            'album_artist_id' => 'required|exists:artists,id',
            'album_release_year' => 'required|string|max:4',
            'album_cover_image' => 'nullable|string|max:255',
            'album_description' => 'nullable|string'
        ]);

        Album::create($request->all());

        return redirect()->route('admin.albums.index')->with('success', 'Album added successfully!');
    }

    public function show($id)
    {
        $album = Album::with(['artist', 'music', 'videos'])->findOrFail($id);
        return view('Admin.albums.show', compact('album'));
    }

    public function edit($id)
    {
        $album = Album::findOrFail($id);
        $artists = Artist::all();
        return view('Admin.albums.edit', compact('album', 'artists'));
    }

    public function update(Request $request, $id)
    {
        $album = Album::findOrFail($id);
        
        $request->validate([
            'album_name' => 'required|string|max:255',
            'album_artist_id' => 'required|exists:artists,id',
            'album_release_year' => 'required|string|max:4',
            'album_cover_image' => 'nullable|string|max:255',
            'album_description' => 'nullable|string'
        ]);

        $album->update($request->all());

        return redirect()->route('admin.albums.index')->with('success', 'Album updated successfully!');
    }

    public function destroy($id)
    {
        Album::findOrFail($id)->delete();
        return redirect()->route('admin.albums.index')->with('success', 'Album deleted successfully!');
    }
}