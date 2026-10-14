<?php

namespace App\Http\Controllers;

use App\Models\Music;
use App\Models\Artist;
use App\Models\Album;
use App\Models\Video;
use App\Models\Review;
use App\Models\User;
use App\Models\Favorite;
use App\Models\Genre;
use App\Models\Language;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $musicCount    = Music::count();
        $artistCount   = Artist::count();
        $albumCount    = Album::count();
        $videoCount    = Video::count();
        $reviewCount   = Review::count();
        $userCount     = User::where('user_role', 'user')->count();
        $genreCount    = Genre::count();
        $languageCount = Language::count();
        $favoriteCount = Favorite::count();

        // Music by year
        $songsByYearRaw = Music::selectRaw('music_year as year, COUNT(*) as count')
            ->whereNotNull('music_year')
            ->where('music_year', '!=', '')
            ->groupBy('music_year')
            ->orderBy('music_year')
            ->pluck('count', 'year')
            ->toArray();

        // Top artists
        $topArtists = Artist::withCount('music')
            ->orderBy('music_count', 'desc')
            ->take(5)
            ->get();

        // Recent users
        $recentUsers = User::orderBy('created_at', 'desc')->take(5)->get();

        // Recent reviews
        $recentReviews = Review::with('user')->latest()->take(5)->get();

        // Songs by genre
        $songsByGenre = Music::select('music_genre_id', DB::raw('COUNT(*) as count'))
            ->whereNotNull('music_genre_id')
            ->groupBy('music_genre_id')
            ->with('genre')
            ->get()
            ->map(function ($item) {
                return [
                    'name' => $item->genre->genre_name ?? 'Unknown',
                    'count' => $item->count,
                ];
            });

        // Average rating
        $avgRating = Review::avg('review_rating') ?? 0;

        // Reviews by rating (1-5 stars)
        $reviewsByRating = [];
        for ($i = 1; $i <= 5; $i++) {
            $reviewsByRating[$i] = Review::where('review_rating', $i)->count();
        }

        // Most favorited albums
        $topFavorited = Album::withCount('favorites')
            ->orderBy('favorites_count', 'desc')
            ->take(5)
            ->get();

        return view('Admin.dashboard', compact(
            'musicCount', 'artistCount', 'albumCount', 'videoCount',
            'reviewCount', 'userCount', 'genreCount', 'languageCount', 'favoriteCount',
            'songsByYearRaw', 'topArtists', 'recentUsers', 'recentReviews',
            'songsByGenre', 'avgRating', 'reviewsByRating', 'topFavorited'
        ));
    }
}