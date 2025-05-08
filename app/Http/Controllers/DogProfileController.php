<?php

namespace App\Http\Controllers;

use App\Models\DogProfile;
use Illuminate\Http\Request;

class DogProfileController extends Controller
{
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

        DogProfile::create($validated);

        return redirect()->route('dogprofiles.index')->with('success', 'Profile saved!');
    }
    public function index()
    {
        $profiles = DogProfile::all();
        return view('dogprofiles.index', compact('profiles'));
    }
}
