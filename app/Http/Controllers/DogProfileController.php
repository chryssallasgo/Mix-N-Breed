<?php

namespace App\Http\Controllers;

use App\Models\DogProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Flasher\Noty\Prime\noty;

class DogProfileController extends Controller
{
    public function edit($id)
    {
        $profile = DogProfile::where('user_id', Auth::id())->findOrFail($id);
        return view('dogprofiles.edit', compact('profile'));
    }
    public function update(Request $request, $id)
    {
        $profile = DogProfile::where('user_id', Auth::id())->findOrFail($id);
        $validated = $request->validate([
            'image' => 'nullable|image|max:2048',
            'name' => 'nullable|string|max:255',
            'breed' => 'required|string|max:255',
            'age' => 'nullable|integer|min:0',
            'size' => 'nullable|string|max:50',
            'traits' => 'nullable|string|max:255',
            'user_id' => 'nullable|exists:users,id',
            'gender' => 'nullable|boolean',
            'weight' => 'nullable|numeric|min:0',
            'vaccination_status' => 'nullable|string|max:255',
            'health_status' => 'nullable|string|max:255',
            'spayed_neutered' => 'nullable|boolean',
            'owner_contact' => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('dog_images', 'public');
        }

        $profile->update($validated);

        noty()->success('Profile updated!');
        return redirect()->route('dogprofiles.index');
    }
    public function create()
    {
        return view('dogprofiles.create');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
            'breed' => 'required|string|max:255',
            'age' => 'nullable|integer|min:0',
            'size' => 'nullable|string|max:50',
            'traits' => 'nullable|string|max:255',
            'user_id' => 'nullable|exists:users,id',
            'gender' => 'nullable|boolean',
            'weight' => 'nullable|numeric|min:0',
            'vaccination_status' => 'nullable|string|max:255',
            'health_status' => 'nullable|string|max:255',
            'spayed_neutered' => 'nullable|boolean',
            'owner_contact' => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date',
        ]);

        $validated['user_id'] = Auth::id();

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('dog_images', 'public');
        }

        DogProfile::create($validated);
        noty()->success('Profile saved!');
        return redirect()->route('dogprofiles.index');
    }
    public function destroy($id)
    {
        $profile = DogProfile::where('user_id', Auth::id())->findOrFail($id);
        $profile->delete();

        noty()->warning('Profile deleted!');
        return redirect()->route('dogprofiles.index');
    }
    public function index()
    {
        $profiles = DogProfile::where('user_id', Auth::id())->get();
        return view('dogprofiles.index', compact('profiles'));
    }
}
