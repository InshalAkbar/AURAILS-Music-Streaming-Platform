<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
    public function index()
    {
        $artists = Artist::all();
        return view('Admin.artist.index', compact('artists'));
    }

    public function create()
    {
        return view('Admin.artist.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'artist_name' => 'required|string|max:255',
            'artist_bio'  => 'nullable|string',
            'artist_image' => 'nullable|string|max:255',
        ]);

        Artist::create([
            'artist_name'  => $request->artist_name,
            'artist_bio'   => $request->artist_bio,
            'artist_image' => $request->artist_image,
        ]);

        return redirect()->route('admin.artists.index')->with('success', 'Artist added successfully!');
    }

    public function show($id)
    {
        $artist = Artist::findOrFail($id);
        return view('Admin.artist.show', compact('artist'));
    }

    public function edit($id)
    {
        $artist = Artist::findOrFail($id);
        return view('Admin.artist.edit', compact('artist'));
    }

    public function update(Request $request, $id)
    {
        $artist = Artist::findOrFail($id);
        
        $request->validate([
            'artist_name' => 'required|string|max:255',
            'artist_bio'  => 'nullable|string',
            'artist_image' => 'nullable|string|max:255',
        ]);

        $artist->update([
            'artist_name'  => $request->artist_name,
            'artist_bio'   => $request->artist_bio,
            'artist_image' => $request->artist_image,
        ]);

        return redirect()->route('admin.artists.index')->with('success', 'Artist updated successfully!');
    }

    public function destroy($id)
    {
        $artist = Artist::findOrFail($id);
        $artist->delete();
        return redirect()->route('admin.artists.index')->with('success', 'Artist deleted successfully!');
    }
}