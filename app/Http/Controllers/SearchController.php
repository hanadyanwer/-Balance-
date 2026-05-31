<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Workout;
use App\Models\Tip;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Search across recipes, workouts, and tips
     */
    public function global(Request $request)
    {
        $query = $request->query('q', '');

        if (strlen($query) < 2) {
            return response()->json(['error' => 'Query must be at least 2 characters'], 400);
        }

        // Search recipes
        $recipes = Recipe::where('name', 'like', "%{$query}%")
            ->orWhere('description', 'like', "%{$query}%")
            ->limit(5)
            ->get();

        // Search workouts
        $workouts = Workout::where('name', 'like', "%{$query}%")
            ->orWhere('description', 'like', "%{$query}%")
            ->limit(5)
            ->get();

        // Search tips
        $tips = Tip::where('title', 'like', "%{$query}%")
            ->orWhere('content', 'like', "%{$query}%")
            ->limit(5)
            ->get();

        if ($request->expectsJson()) {
            return response()->json([
                'recipes' => $recipes,
                'workouts' => $workouts,
                'tips' => $tips,
            ]);
        }

        return view('search-results', compact('recipes', 'workouts', 'tips', 'query'));
    }

    /**
     * Search recipes only
     */
    public function recipes(Request $request)
    {
        $query = $request->query('q', '');
        $mealType = $request->query('meal_type');

        $search = Recipe::query();

        if ($query) {
            $search->where('name', 'like', "%{$query}%")
                ->orWhere('description', 'like', "%{$query}%");
        }

        if ($mealType && in_array($mealType, ['breakfast', 'lunch', 'dinner', 'snack'])) {
            $search->where('meal_type', $mealType);
        }

        $recipes = $search->paginate(12);

        if ($request->expectsJson()) {
            return response()->json($recipes);
        }

        return view('recipes-search', compact('recipes', 'query'));
    }

    /**
     * Search workouts only
     */
    public function workouts(Request $request)
    {
        $query = $request->query('q', '');
        $type = $request->query('type');
        $difficulty = $request->query('difficulty');

        $search = Workout::query();

        if ($query) {
            $search->where('name', 'like', "%{$query}%")
                ->orWhere('description', 'like', "%{$query}%");
        }

        if ($type && in_array($type, ['cardio', 'strength', 'flexibility', 'balance', 'hiit'])) {
            $search->where('type', $type);
        }

        if ($difficulty && in_array($difficulty, ['beginner', 'intermediate', 'advanced'])) {
            $search->where('difficulty', $difficulty);
        }

        $workouts = $search->paginate(12);

        if ($request->expectsJson()) {
            return response()->json($workouts);
        }

        return view('workouts-search', compact('workouts', 'query'));
    }

    /**
     * Search tips only
     */
    public function tips(Request $request)
    {
        $query = $request->query('q', '');
        $category = $request->query('category');

        $search = Tip::query();

        if ($query) {
            $search->where('title', 'like', "%{$query}%")
                ->orWhere('content', 'like', "%{$query}%");
        }

        if ($category && in_array($category, ['nutrition', 'fitness', 'wellness', 'mental_health', 'sleep'])) {
            $search->where('category', $category);
        }

        $tips = $search->paginate(12);

        if ($request->expectsJson()) {
            return response()->json($tips);
        }

        return view('tips-search', compact('tips', 'query'));
    }
}
