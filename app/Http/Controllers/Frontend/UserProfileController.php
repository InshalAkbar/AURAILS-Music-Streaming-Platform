<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $favoritesCount = Favorite::where('user_id', $user->id)->count();
        $reviewsCount   = Review::where('review_user_id', $user->id)->count();

        $recentReviews = Review::where('review_user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        $favoriteAlbums = Favorite::with('album.artist')
            ->where('user_id', $user->id)
            ->latest()
            ->take(4)
            ->get();

        return view('Frontend.profile', compact(
            'user', 'favoritesCount', 'reviewsCount', 'recentReviews', 'favoriteAlbums'
        ));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'user_name'    => 'required|string|max:255',
            'user_phone'   => 'nullable|string|max:30',
            'user_address' => 'nullable|string|max:500',
        ]);

        $user->update([
            'user_name'    => $request->user_name,
            'user_phone'   => $request->user_phone,
            'user_address' => $request->user_address,
        ]);

        return back()->with('success', 'Profile updated successfully!');
    }

    public function updateAvatar(Request $request)
    {
        $request->validate([
            'user_image' => 'required|image|mimes:jpeg,jpg,png,webp|max:2048',
        ], [
            'user_image.required' => 'Please select an image.',
            'user_image.image'    => 'File must be an image.',
            'user_image.mimes'    => 'Only JPG, PNG, or WebP allowed.',
            'user_image.max'      => 'Image must be under 2MB.',
        ]);

        $user = Auth::user();

        // Delete old image if exists
        if ($user->user_image && Storage::disk('public')->exists($user->user_image)) {
            Storage::disk('public')->delete($user->user_image);
        }

        // Store new image
        $path = $request->file('user_image')->store('users', 'public');

        $user->update(['user_image' => $path]);

        return back()->with('success', 'Profile picture updated successfully!');
    }

    public function removeAvatar()
    {
        $user = Auth::user();

        if ($user->user_image && Storage::disk('public')->exists($user->user_image)) {
            Storage::disk('public')->delete($user->user_image);
        }

        $user->update(['user_image' => null]);

        return back()->with('success', 'Profile picture removed.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password'         => 'required|min:6|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->user_password)) {
            return back()->with('error', 'Current password is incorrect.');
        }

        $user->update([
            'user_password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Password changed successfully!');
    }
}