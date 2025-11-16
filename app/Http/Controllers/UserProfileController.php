<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    public function show()
    {
        return view('userprofile.index');
    }
    public function edit()
    {
        return view('userprofile.edit');
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->update($request->only(['name', 'email']));

        return redirect()->route('userprofile.show')->with('message', 'Profile updated successfully!');
    }
}
