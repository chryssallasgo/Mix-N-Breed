<?php

namespace App\Http\Controllers;

use App\Models\DogProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $dogCount = DogProfile::count();
        $matchCount = 5;
        $tipCount = 3;
        return view('dashboard', compact('dogCount', 'matchCount', 'tipCount'));
    }
    public function tryItOut()
    {
        if (Auth::check()) {
            flash()->warning('Please login or register to try DogMatch!');
            return redirect()->route('login');
        }

        return redirect()->route('dogmatch.form');
    }
    public function addDogProfile()
    {
        if (Auth::check()) {
            flash()->warning('Please login or register to add a dog profile.');
            return redirect()->route('login');
        }

        // Show add dog profile form
        return view('dogprofiles.create');
    }
}
