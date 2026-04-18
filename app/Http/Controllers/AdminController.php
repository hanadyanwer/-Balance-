<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Workout;
use App\Models\Tip;
use App\Models\User;
use App\Models\DailyPlan;
use App\Models\Notification;
use App\Models\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    // Dashboard
    public function dashboard()
    {
        $stats = [
            'users' => User::count(),
            'recipes' => Recipe::count(),
            'workouts' => Workout::count(),
            'tips' => Tip::count(),
            'daily_plans' => DailyPlan::count(),
        ];

        // Get latest users
        $latestUsers = User::orderBy('created_at', 'desc')->take(5)->get();

        return view('admaindash', compact('stats', 'latestUsers'));
    }

    // ==================== RECIPES ====================

    public function recipesIndex(Request $request)
    {
        $query = Recipe::query();

        // Filter by meal type if provided
        if ($request->has('meal_type') && in_array($request->meal_type, ['breakfast', 'lunch', 'dinner', 'snack'])) {
            $query->where('meal_type', $request->meal_type);
        }

        $recipes = $query->orderBy('created_at', 'desc')->get();
        $mealType = $request->meal_type;

        return view('admainrecipes', compact('recipes', 'mealType'));
    }

    public function recipesCreate()
    {
        return view('admin.recipes.create');
    }

    public function recipesStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'meal_type' => 'required|in:breakfast,lunch,snack,dinner',
            'description' => 'nullable|string',
            'ingredients' => 'nullable|string',
            'instructions' => 'nullable|string',
            'calories' => 'nullable|integer|min:0',
            'protein' => 'nullable|integer|min:0',
            'carbs' => 'nullable|integer|min:0',
            'fats' => 'nullable|integer|min:0',
            'prep_time' => 'nullable|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
        ]);

        // Auto-generate nutrition_profile from individual values
        if (isset($validated['protein']) || isset($validated['carbs']) || isset($validated['fats'])) {
            $protein = $validated['protein'] ?? 0;
            $carbs = $validated['carbs'] ?? 0;
            $fats = $validated['fats'] ?? 0;
            $validated['nutrition_profile'] = "Prot: {$protein}g | Carbs: {$carbs}g | Fats: {$fats}g";
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $validated['image'] = 'images/' . $imageName;
        }

        Recipe::create($validated);

        return redirect()->route('admin.recipes.index')->with('success', 'Recipe created successfully!');
    }

    public function recipesEdit(Recipe $recipe)
    {
        return view('admin.recipes.edit', compact('recipe'));
    }

    public function recipesUpdate(Request $request, Recipe $recipe)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'meal_type' => 'required|in:breakfast,lunch,snack,dinner',
            'description' => 'nullable|string',
            'ingredients' => 'nullable|string',
            'instructions' => 'nullable|string',
            'calories' => 'nullable|integer|min:0',
            'protein' => 'nullable|integer|min:0',
            'carbs' => 'nullable|integer|min:0',
            'fats' => 'nullable|integer|min:0',
            'prep_time' => 'nullable|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
        ]);

        // Auto-generate nutrition_profile from individual values
        if (isset($validated['protein']) || isset($validated['carbs']) || isset($validated['fats'])) {
            $protein = $validated['protein'] ?? 0;
            $carbs = $validated['carbs'] ?? 0;
            $fats = $validated['fats'] ?? 0;
            $validated['nutrition_profile'] = "Prot: {$protein}g | Carbs: {$carbs}g | Fats: {$fats}g";
        }

        if ($request->hasFile('image')) {
            // Delete old image
            if ($recipe->image && file_exists(public_path($recipe->image))) {
                unlink(public_path($recipe->image));
            }

            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $validated['image'] = 'images/' . $imageName;
        }

        $recipe->update($validated);

        return redirect()->route('admin.recipes.index')->with('success', 'Recipe updated successfully!');
    }

    public function recipesDestroy(Recipe $recipe)
    {
        if ($recipe->image && file_exists(public_path($recipe->image))) {
            unlink(public_path($recipe->image));
        }

        $recipe->delete();

        return redirect()->route('admin.recipes.index')->with('success', 'Recipe deleted successfully!');
    }

    // ==================== WORKOUTS ====================

    public function workoutsIndex()
    {
        $workouts = Workout::orderBy('created_at', 'desc')->get();
        return view('admainwork', compact('workouts'));
    }

    public function workoutsCreate()
    {
        return view('admin.workouts.create');
    }

    public function workoutsStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:cardio,strength,flexibility,balance,hiit',
            'description' => 'nullable|string',
            'duration' => 'nullable|integer|min:0',
            'difficulty' => 'required|in:beginner,intermediate,advanced',
            'calories_burned' => 'nullable|integer|min:0',
            'equipment' => 'nullable|string',
            'instructions' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'video_url' => 'nullable|url|max:500',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $validated['image'] = 'images/' . $imageName;
        }

        Workout::create($validated);

        return redirect()->route('admin.workouts.index')->with('success', 'Workout created successfully!');
    }

    public function workoutsEdit(Workout $workout)
    {
        return view('admin.workouts.edit', compact('workout'));
    }

    public function workoutsUpdate(Request $request, Workout $workout)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:cardio,strength,flexibility,balance,hiit',
            'description' => 'nullable|string',
            'duration' => 'nullable|integer|min:0',
            'difficulty' => 'required|in:beginner,intermediate,advanced',
            'calories_burned' => 'nullable|integer|min:0',
            'equipment' => 'nullable|string',
            'instructions' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'video_url' => 'nullable|url|max:500',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($workout->image && file_exists(public_path($workout->image))) {
                unlink(public_path($workout->image));
            }

            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $validated['image'] = 'images/' . $imageName;
        }

        $workout->update($validated);

        return redirect()->route('admin.workouts.index')->with('success', 'Workout updated successfully!');
    }

    public function workoutsDestroy(Workout $workout)
    {
        if ($workout->image && file_exists(public_path($workout->image))) {
            unlink(public_path($workout->image));
        }

        $workout->delete();

        return redirect()->route('admin.workouts.index')->with('success', 'Workout deleted successfully!');
    }

    // ==================== TIPS ====================

    public function tipsIndex()
    {
        $tips = Tip::orderBy('created_at', 'desc')->get();
        return view('admaintips', compact('tips'));
    }

    public function tipsCreate()
    {
        return view('admin.tips.create');
    }

    public function tipsStore(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|in:nutrition,fitness,wellness,mental_health,sleep',
        ]);

        Tip::create($validated);

        return redirect()->route('admin.tips.index')->with('success', 'Tip created successfully!');
    }

    public function tipsEdit(Tip $tip)
    {
        return view('admin.tips.edit', compact('tip'));
    }

    public function tipsUpdate(Request $request, Tip $tip)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|in:nutrition,fitness,wellness,mental_health,sleep',
        ]);

        $tip->update($validated);

        return redirect()->route('admin.tips.index')->with('success', 'Tip updated successfully!');
    }

    public function tipsDestroy(Tip $tip)
    {
        $tip->delete();
        return redirect()->route('admin.tips.index')->with('success', 'Tip deleted successfully!');
    }

    // ==================== DAILY PLANS ====================

    public function dailyPlansIndex()
    {
        $dailyPlans = DailyPlan::with('user')->orderBy('created_at', 'desc')->paginate(15);
        return view('admaindaily', compact('dailyPlans'));
    }

    // ==================== HYDRATION ====================

    public function hydrationIndex()
    {
        // For now, just return the view
        // You can add hydration tracking functionality later
        return view('admindrink');
    }

    // ==================== NOTIFICATIONS ====================

    public function getNotifications()
    {
        $notifications = Notification::orderBy('created_at', 'desc')->take(10)->get();
        $unreadCount = Notification::where('is_read', false)->count();

        return response()->json([
            'notifications' => $notifications,
            'unreadCount' => $unreadCount
        ]);
    }

    public function markNotificationAsRead($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->update(['is_read' => true]);

        return response()->json(['success' => true]);
    }

    public function markAllNotificationsAsRead()
    {
        Notification::where('is_read', false)->update(['is_read' => true]);

        return response()->json(['success' => true]);
    }

    // ==================== STORIES ====================

    public function storiesIndex()
    {
        $stories = Story::with('user')->orderBy('created_at', 'desc')->get();
        return view('admainstories', compact('stories'));
    }

    public function storiesApprove($id)
    {
        $story = Story::findOrFail($id);
        $story->is_approved = true;
        $story->save();

        return redirect()->back()->with('success', 'Story approved successfully!');
    }

    public function storiesReject($id)
    {
        $story = Story::findOrFail($id);
        $story->delete();

        return redirect()->back()->with('success', 'Story rejected and deleted successfully!');
    }

    public function storiesDestroy($id)
    {
        $story = Story::findOrFail($id);

        // Delete image if exists
        if ($story->image && file_exists(public_path($story->image))) {
            unlink(public_path($story->image));
        }

        $story->delete();

        return redirect()->back()->with('success', 'Story deleted successfully!');
    }
}
