<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\DogProfile;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function dashboard()
    {
        $totalUsers = User::count();
        $totalDogProfiles = \App\Models\DogProfile::count();

        $users = User::orderBy('created_at', 'desc')->paginate(10);
        $dogProfiles = \App\Models\DogProfile::with('user')->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.dashboard', compact('totalUsers', 'totalDogProfiles', 'users', 'dogProfiles'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'is_admin' => 'sometimes|boolean',
        ]);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'is_admin' => $request->has('is_admin')
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User updated.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.dashboard')->with('success', 'User deleted.');
    }

    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.users.index', compact('users'));
    }
}
