<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::all();
        return view('Admin.genres.index', compact('genres'));
    }

    public function create()
    {
        return view('Admin.genres.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'genre_name' => 'required|string|max:255'
        ]);

        Genre::create([
            'genre_name' => $request->genre_name
        ]);

        return redirect()->route('admin.genres.index')->with('success', 'Genre added successfully!');
    }

    public function edit($id)
    {
        $genre = Genre::findOrFail($id);
        return view('Admin.genres.edit', compact('genre'));
    }

    public function update(Request $request, $id)
    {
        $genre = Genre::findOrFail($id);
        
        $request->validate([
            'genre_name' => 'required|string|max:255'
        ]);

        $genre->update([
            'genre_name' => $request->genre_name
        ]);

        return redirect()->route('admin.genres.index')->with('success', 'Genre updated successfully!');
    }

    public function destroy($id)
    {
        Genre::findOrFail($id)->delete();
        return redirect()->route('admin.genres.index')->with('success', 'Genre deleted successfully!');
    }

    public function show($id)
    {
        $genre = Genre::findOrFail($id);
        return view('Admin.genres.show', compact('genre'));
    }
}