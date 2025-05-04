<?php

namespace App\Http\Controllers;

use App\Models\Dog;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $dogCount = Dog::count();
        $matchCount = 5;
        $tipCount = 3;
        return view('dashboard', compact('dogCount', 'matchCount', 'tipCount'));
    }
}
