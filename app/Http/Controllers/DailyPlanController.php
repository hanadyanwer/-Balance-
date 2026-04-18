<?php

namespace App\Http\Controllers;

use App\Models\DailyPlan;
use App\Models\Recipe;
use App\Models\Workout;
use App\Models\Tip;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DailyPlanController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $today = Carbon::today();

        // Get or create today's plan
        $todayPlan = DailyPlan::where('user_id', $user->id)
            ->where('plan_date', $today)
            ->with(['breakfast', 'lunch', 'snack', 'dinner', 'workout', 'tip'])
            ->first();

        if (!$todayPlan) {
            // Create a new plan for today
            $todayPlan = $this->generateDailyPlan($user->id, $today);
        }

        // Get plans for the week efficiently (one query)
        $weekStart = Carbon::today();
        $weekEnd = Carbon::today()->addDays(6);

        $existingPlans = DailyPlan::where('user_id', $user->id)
            ->whereBetween('plan_date', [$weekStart, $weekEnd])
            ->with(['breakfast', 'lunch', 'snack', 'dinner', 'workout', 'tip'])
            ->get()
            ->keyBy(function($item) {
                return $item->plan_date->format('Y-m-d');
            });

        $weekPlans = [];
        for ($i = 0; $i < 7; $i++) {
            $date = Carbon::today()->addDays($i);
            $dateKey = $date->format('Y-m-d');

            if (isset($existingPlans[$dateKey])) {
                $plan = $existingPlans[$dateKey];
            } else {
                $plan = $this->generateDailyPlan($user->id, $date);
            }

            $weekPlans[] = [
                'date' => $date,
                'plan' => $plan,
                'isToday' => $date->isToday(),
            ];
        }

        return view('daily-plan', compact('todayPlan', 'weekPlans'));
    }

    private function generateDailyPlan($userId, $date)
    {
        $user = Auth::user();
        $goal = $user->health_goal ?? 'maintain';

        // تحديد معايير اختيار الوصفات حسب الهدف
        $recipeQuery = function($mealType) use ($goal) {
            $query = Recipe::where('meal_type', $mealType);

            switch ($goal) {
                case 'lose_weight':
                    // اختر وصفات منخفضة السعرات (أقل من 400 كالوري)
                    $query->where('calories', '<=', 400);
                    break;

                case 'gain_weight':
                    // اختر وصفات عالية السعرات (أكثر من 400 كالوري)
                    $query->where('calories', '>=', 400);
                    break;

                case 'build_muscle':
                    // اختر وصفات عالية البروتين (أكثر من 20 جرام)
                    $query->where('protein', '>=', 20);
                    break;

                case 'maintain':
                default:
                    // لا توجد تصفية إضافية
                    break;
            }

            return $query;
        };

        // Select recipes based on goal
        $breakfast = $recipeQuery('breakfast')->inRandomOrder()->first();
        $lunch = $recipeQuery('lunch')->inRandomOrder()->first();
        $snack = $recipeQuery('snack')->inRandomOrder()->first();
        $dinner = $recipeQuery('dinner')->inRandomOrder()->first();

        // إذا لم نجد وصفات مناسبة للهدف، نختار أي وصفة
        if (!$breakfast) $breakfast = Recipe::where('meal_type', 'breakfast')->inRandomOrder()->first();
        if (!$lunch) $lunch = Recipe::where('meal_type', 'lunch')->inRandomOrder()->first();
        if (!$snack) $snack = Recipe::where('meal_type', 'snack')->inRandomOrder()->first();
        if (!$dinner) $dinner = Recipe::where('meal_type', 'dinner')->inRandomOrder()->first();

        // Select random workout and tip
        $workout = Workout::inRandomOrder()->first();
        $tip = Tip::inRandomOrder()->first();

        // Create the daily plan
        $plan = DailyPlan::create([
            'user_id' => $userId,
            'plan_date' => $date,
            'breakfast_id' => $breakfast?->id,
            'lunch_id' => $lunch?->id,
            'snack_id' => $snack?->id,
            'dinner_id' => $dinner?->id,
            'workout_id' => $workout?->id,
            'tip_id' => $tip?->id,
        ]);

        // Immediately load relationships without another query
        $plan->setRelation('breakfast', $breakfast);
        $plan->setRelation('lunch', $lunch);
        $plan->setRelation('snack', $snack);
        $plan->setRelation('dinner', $dinner);
        $plan->setRelation('workout', $workout);
        $plan->setRelation('tip', $tip);

        return $plan;
    }

    public function regenerate(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $user = Auth::user();
        $date = $request->date ? Carbon::parse($request->date) : Carbon::today();

        // Delete existing plan for this date
        DailyPlan::where('user_id', $user->id)
            ->where('plan_date', $date)
            ->delete();

        // Generate new plan
        $plan = $this->generateDailyPlan($user->id, $date);

        // Create notification for admin
        Notification::create([
            'type' => 'plan_regenerated',
            'title' => 'Plan Regenerated',
            'message' => "User {$user->name} regenerated their daily plan for {$date->format('Y-m-d')}.",
            'link' => route('admin.daily-plans.index'),
            'is_read' => false,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Daily plan regenerated successfully!',
            'plan' => $plan
        ]);
    }
}
