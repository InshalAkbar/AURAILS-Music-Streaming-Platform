<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index()
    {
        $favorites = Favorite::where('user_id', Auth::id())->with('album')->latest()->get();
        return view('Frontend.favorites', compact('favorites'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'album_id' => 'required|exists:albums,id'
        ]);

        $exists = Favorite::where('user_id', Auth::id())
                          ->where('album_id', $request->album_id)
                          ->exists();

        if (!$exists) {
            Favorite::create([
                'user_id' => Auth::id(),
                'album_id' => $request->album_id,
            ]);
        }

        return back()->with('success', 'Album added to favorites!');
    }

    public function destroy($id)
    {
        $favorite = Favorite::where('user_id', Auth::id())->findOrFail($id);
        $favorite->delete();

        return back()->with('success', 'Removed from favorites.');
    }
}