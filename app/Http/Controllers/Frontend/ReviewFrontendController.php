<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewFrontendController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'review_media_type' => 'required|in:music,video',
            'review_media_id'   => 'required|integer',
            'review_rating'     => 'required|integer|min:1|max:5',
            'review_text'       => 'required|string|max:1000',
        ]);

        $exists = Review::where('review_user_id', Auth::id())
            ->where('review_media_type', $request->review_media_type)
            ->where('review_media_id', $request->review_media_id)
            ->exists();

        if ($exists) {
            return back()->with('error', 'You have already reviewed this item.');
        }

        Review::create([
            'review_user_id'    => Auth::id(),
            'review_media_type' => $request->review_media_type,
            'review_media_id'   => $request->review_media_id,
            'review_rating'     => $request->review_rating,
            'review_text'       => $request->review_text,
        ]);

        return back()->with('success', 'Thank you! Your review has been submitted.');
    }

    public function destroy($id)
    {
        $review = Review::where('review_user_id', Auth::id())->findOrFail($id);
        $review->delete();

        return back()->with('success', 'Your review has been removed.');
    }
}