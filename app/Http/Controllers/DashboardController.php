<?php

namespace App\Http\Controllers;

use App\Models\DogProfile;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $dogCount = DogProfile::count();
        $matchCount = 5;
        $tipCount = 3;
        return view('dashboard', compact('dogCount', 'matchCount', 'tipCount'));
    }
}
