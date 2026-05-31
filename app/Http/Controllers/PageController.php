<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Workout;
use App\Models\Tip;
use App\Models\Story;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        // Cache stories for 1 hour
        $stories = Cache::remember('approved_stories_home', 3600, function () {
            return Story::where('is_approved', true)
                ->latest()
                ->take(6)
                ->get();
        });
        return view('home', compact('stories'));
    }

    public function workouts(Request $request)
    {
        // Paginate workouts (15 per page)
        $workouts = Workout::paginate(15);
        return view('workouts', compact('workouts'));
    }

    public function services(Request $request)
    {
        // Paginate tips (12 per page)
        $tips = Tip::paginate(12);
        return view('services', compact('tips'));
    }

    public function recipes(Request $request)
    {
        // Paginate recipes (12 per page) - can filter by meal_type
        $query = Recipe::query();

        if ($request->has('meal_type') && in_array($request->meal_type, ['breakfast', 'lunch', 'dinner', 'snack'])) {
            $query->where('meal_type', $request->meal_type);
        }

        $recipes = $query->paginate(12);
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
