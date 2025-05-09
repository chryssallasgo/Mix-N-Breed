<?php

namespace App\Http\Controllers;

use App\Models\DogProfile;
use Illuminate\Http\Request;

class DogProfileController extends Controller
{
    public function edit($id)
    {
        //$profile = DogProfile::findOrFail($id);
        $profile = auth()->user()->dogProfiles()->findOrFail($id);
        return view('dogprofiles.edit', compact('profile'));
    }
    public function update(Request $request, $id)
    {
        //$profile = DogProfile::findOrFail($id);
        $profile = auth()->user()->dogProfiles()->findOrFail($id);
        $validated = $request->validate([
            'image' => 'nullable|image|max:2048',
            'breed' => 'required|string|max:255',
            'age' => 'nullable|integer|min:0',
            'size' => 'nullable|string|max:50',
            'traits' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('dog_images', 'public');
        }

        $profile->update($validated);

        return redirect()->route('dogprofiles.index')->with('success', 'Profile updated!');
    }
    public function create()
    {
        return view('dogprofiles.create');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => 'nullable|image|max:2048',
            'breed' => 'required|string|max:255',
            'age' => 'nullable|integer|min:0',
            'size' => 'nullable|string|max:50',
            'traits' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('dog_images', 'public');
        }

        $validated['user_id'] = auth()->id();

        DogProfile::create($validated);

        return redirect()->route('dogprofiles.index')->with('success', 'Profile saved!');
    }
    public function destroy($id)
    {
        //$profile = DogProfile::findOrFail($id);
        $profile = auth()->user()->dogProfiles()->findOrFail($id);
        $profile->delete();

        return redirect()->route('dogprofiles.index')->with('success', 'Profile deleted!');
    }
    public function index()
    {
        //$profiles = DogProfile::all();
        $profiles = auth()->user()->dogProfiles;
        return view('dogprofiles.index', compact('profiles'));
    }
}
