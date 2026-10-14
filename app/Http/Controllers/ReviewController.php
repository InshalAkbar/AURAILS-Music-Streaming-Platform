<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with('user')->get();
        return view('Admin.review.index', compact('reviews'));
    }

    public function create()
    {
        $users = User::all();
        return view('Admin.review.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'review_user_id'    => 'required|exists:users,id',
            'review_media_type' => 'required|in:music,video',
            'review_media_id'   => 'required|integer',
            'review_rating'     => 'required|integer|min:1|max:5',
            'review_text'       => 'required|string',
        ]);

        Review::create($request->all());

        return redirect()->route('admin.reviews.index')->with('success', 'Review added successfully!');
    }

    public function show($id)
    {
        $review = Review::with('user')->findOrFail($id);
        return view('Admin.review.show', compact('review'));
    }

    public function edit($id)
    {
        $review = Review::findOrFail($id);
        $users = User::all();
        return view('Admin.review.edit', compact('review', 'users'));
    }

    public function update(Request $request, $id)
    {
        $review = Review::findOrFail($id);

        $request->validate([
            'review_user_id'    => 'required|exists:users,id',
            'review_media_type' => 'required|in:music,video',
            'review_media_id'   => 'required|integer',
            'review_rating'     => 'required|integer|min:1|max:5',
            'review_text'       => 'required|string',
        ]);

        $review->update($request->all());

        return redirect()->route('admin.reviews.index')->with('success', 'Review updated successfully!');
    }

    public function destroy($id)
    {
        Review::findOrFail($id)->delete();
        return redirect()->route('admin.reviews.index')->with('success', 'Review deleted successfully!');
    }
}