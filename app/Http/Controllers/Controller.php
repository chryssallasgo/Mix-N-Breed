<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

abstract class Controller
{
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to update your profile.');
        }

        $user = Auth::user();

        if (!$user instanceof \App\Models\User) {
            abort(404, 'User not found or invalid.');
        }

        $user->update($request->only('name'));

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}
