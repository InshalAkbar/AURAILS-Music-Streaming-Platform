<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        return view('Admin.users.index', compact('users'));
    }

    public function show($id)
    {
        $user = User::with(['favorites.album.artist', 'reviews'])->findOrFail($id);
        return view('Admin.users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('Admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'user_name'    => 'required|string|max:255',
            'user_email'   => 'required|email|unique:users,user_email,' . $id,
            'user_phone'   => 'nullable|string|max:30',
            'user_address' => 'nullable|string|max:500',
            'user_role'    => 'required|in:user,admin',
        ]);

        $user->update([
            'user_name'    => $request->user_name,
            'user_email'   => $request->user_email,
            'user_phone'   => $request->user_phone,
            'user_address' => $request->user_address,
            'user_role'    => $request->user_role,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully!');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully!');
    }
}