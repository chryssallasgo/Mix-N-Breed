<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DogProfile;
use Illuminate\Http\Request;

class DogProfileController extends Controller
{
    public function index()
    {
        $dogProfiles = DogProfile::with('user')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.dogprofiles.index', compact('dogProfiles'));
    }

    public function edit($id)
    {
        $profile = DogProfile::findOrFail($id);
        return view('admin.dogprofiles.edit', compact('profile'));
    }

    public function update(Request $request, $id)
    {
        $profile = DogProfile::findOrFail($id);

        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'breed' => 'required|string|max:255',
            'age' => 'nullable|integer|min:0',
            'size' => 'nullable|string|max:50',
            'traits' => 'nullable|string|max:255',
            'user_id' => 'nullable|exists:users,id',
            'image' => 'nullable|image|max:2048',
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

        return redirect()->route('admin.dogprofiles.index')->with('success', 'Dog profile updated.');
    }

    public function destroy($id)
    {
        $profile = DogProfile::findOrFail($id);
        $profile->delete();

        return redirect()->route('admin.admindashboard')->with('success', 'Dog profile deleted.');
    }
}
