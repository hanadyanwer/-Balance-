<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    public function index(Request $request)
    {
        $query = Recipe::query();

        if ($request->filled('meal_type') && in_array($request->meal_type, ['breakfast', 'lunch', 'dinner', 'snack'])) {
            $query->where('meal_type', $request->meal_type);
        }

        $recipes = $query->orderBy('created_at', 'desc')->paginate(12);

        return view('Recipes', compact('recipes'));
    }
}
