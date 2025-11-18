<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Storage;

use function Flasher\Noty\Prime\noty;
use function Flasher\Toastr\Prime\toastr;

class UserProfileController extends Controller
{
    public function index()
    {
        return view('userprofile.index');
    }
    public function edit(Request $request)
    {
        return view('userprofile.edit', [
            'userprofile' => $request->user(),
        ]);
    }
    public function update(Request $request)
    {
        $userprofile = $request->user();

        $validated = $request->validate([
            'name' =>  ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255']

        ]);

        $userprofile->fill($validated);

        if ($userprofile->isDirty('email')) {
            $userprofile->email_verified_at = null;
        }

        $userprofile->update($validated);

        noty()->success('Profile updated successfully!');
        return redirect()->route('userprofile.edit');
    }
    public function updatePassword(Request $request)
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);
        noty()->info('Password has been updated');
        return redirect()->route('userprofile.edit');
    }
    public function updateProfilePicture(Request $request)
    {
        $request->validate([
            'profile_picture' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'], // 2MB max
        ]);

        $user = $request->user();

        // Delete old profile picture if it exists
        if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
            Storage::disk('public')->delete($user->profile_picture);
        }

        // Store new profile picture
        $path = $request->file('profile_picture')->store('profile-pictures', 'public');

        $user->update([
            'profile_picture' => $path,
        ]);

        return back()->with('success', 'Profile picture updated successfully!');
    }
    public function destroy(Request $request)
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        noty()->warning('Account has been deleted');
        return redirect('/');
    }
}
