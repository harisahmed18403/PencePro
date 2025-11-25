<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{    // Show user profile
    public function show()
    {
        $user = Auth::user();
        return view('user.show', compact('user'));
    }

    // Show edit form
    public function edit()
    {
        $user = Auth::user();
        return view('user.edit', compact('user'));
    }

    // Update user profile
    public function update(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6|confirmed',
        ]);

        $user->name = $data['name'];
        $user->email = $data['email'];

        if (!empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }

        $user->save();

        return redirect()->route('user.show')->with('success', 'Profile updated successfully.');
    }
}
