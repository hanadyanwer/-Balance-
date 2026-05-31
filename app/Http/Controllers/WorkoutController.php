<?php

namespace App\Http\Controllers;

use App\Models\Workout;
use Illuminate\Http\Request;

class WorkoutController extends Controller
{
    public function index(Request $request)
    {
        $query = Workout::query();

        if ($request->filled('type') && in_array($request->type, ['cardio', 'strength', 'flexibility', 'balance', 'hiit'])) {
            $query->where('type', $request->type);
        }

        if ($request->filled('difficulty') && in_array($request->difficulty, ['beginner', 'intermediate', 'advanced'])) {
            $query->where('difficulty', $request->difficulty);
        }

        $workouts = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('workouts', compact('workouts'));
    }
}
