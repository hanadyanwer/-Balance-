<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Workout;
use App\Models\Tip;
use App\Models\Story;

class PageController extends Controller
{
    public function home()
    {
        $stories = Story::where('is_approved', true)->latest()->take(6)->get();
        return view('home', compact('stories'));
    }

    public function workouts()
    {
        $workouts = Workout::all();
        return view('workouts', compact('workouts'));
    }

    public function services()
    {
        $tips = Tip::all();
        return view('services', compact('tips'));
    }

    public function recipes()
    {
        $recipes = Recipe::all();
        return view('Recipes', compact('recipes'));
    }

    public function profile()
    {
        return view('profile');
    }

    public function logout()
    {
        return view('logout');
    }

    public function index()
    {
        $stories = Story::where('is_approved', true)->latest()->take(6)->get();
        return view('index', compact('stories'));
    }

    public function reset()
    {
        return view('reset');
    }

    public function waterTracking()
    {
        return view('water-tracking');
    }
}
