<?php

namespace App\Http\Controllers;

use App\LickImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
class UserController extends Controller
{
    use LickImageTrait;
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

    public function destroy(Request $request)
    {
        $user = User::with('licks.images')->find(auth()->id());

        $request->validate([
            'password' => 'required',
        ]);

        if (!\Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Incorrect password.']);
        }

        // Delete images
        foreach ($user->licks as $lick) {
            foreach ($lick->images as $lickImage) {
                $this->deleteLickImage($lickImage);
            }
        }

        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Your account has been deleted.');
    }
}
