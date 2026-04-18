<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Recipe;
use App\Models\Workout;
use App\Models\Tip;

class DailyPlanSeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing data
        Recipe::truncate();
        Workout::truncate();
        Tip::truncate();

        // Seed Recipes
        $recipes = [
            // Breakfasts
            [
                'name' => 'Oatmeal with Berries',
                'meal_type' => 'breakfast',
                'description' => 'A healthy and filling breakfast with fresh berries and nuts',
                'ingredients' => '1 cup oats, 2 cups almond milk, 1/2 cup mixed berries, 1 tbsp honey, handful of almonds',
                'instructions' => 'Cook oats in almond milk for 5 minutes. Top with berries, honey, and almonds.',
                'calories' => 350,
                'protein' => 12,
                'carbs' => 55,
                'fats' => 10,
                'prep_time' => 10,
                'image' => 'images/altumcode-BT-Cx1n1LXA-unsplash.jpg',
            ],
            [
                'name' => 'Greek Yogurt Parfait',
                'meal_type' => 'breakfast',
                'description' => 'Protein-rich yogurt layered with granola and fresh fruits',
                'ingredients' => '1 cup Greek yogurt, 1/4 cup granola, 1/2 cup mixed fruits, 1 tsp honey',
                'instructions' => 'Layer yogurt with granola and fruits. Drizzle with honey.',
                'calories' => 280,
                'protein' => 20,
                'carbs' => 35,
                'fats' => 6,
                'prep_time' => 5,
                'image' => 'images/healthy.jfif',
            ],
            [
                'name' => 'Avocado Toast',
                'meal_type' => 'breakfast',
                'description' => 'Whole grain toast topped with creamy avocado and poached egg',
                'ingredients' => '2 slices whole grain bread, 1 ripe avocado, 2 eggs, salt, pepper, chili flakes',
                'instructions' => 'Toast bread, mash avocado on top, add poached egg and seasonings.',
                'calories' => 320,
                'protein' => 15,
                'carbs' => 28,
                'fats' => 18,
                'prep_time' => 12,
                'image' => 'images/altumcode-BT-Cx1n1LXA-unsplash.jpg',
            ],

            // Lunches
            [
                'name' => 'Grilled Chicken Salad',
                'meal_type' => 'lunch',
                'description' => 'Fresh greens with grilled chicken breast and balsamic dressing',
                'ingredients' => 'Mixed greens, 150g grilled chicken, cherry tomatoes, cucumber, olive oil, balsamic vinegar',
                'instructions' => 'Grill chicken, slice and place on bed of greens. Add vegetables and drizzle with dressing.',
                'calories' => 380,
                'protein' => 35,
                'carbs' => 15,
                'fats' => 20,
                'prep_time' => 20,
                'image' => 'images/sumit-bhatia-g7WrssBb1Ak-unsplash.jpg',
            ],
            [
                'name' => 'Quinoa Buddha Bowl',
                'meal_type' => 'lunch',
                'description' => 'Nutritious bowl with quinoa, roasted vegetables, and tahini sauce',
                'ingredients' => '1 cup cooked quinoa, roasted sweet potato, chickpeas, kale, tahini sauce',
                'instructions' => 'Arrange quinoa and roasted vegetables in bowl. Drizzle with tahini sauce.',
                'calories' => 420,
                'protein' => 18,
                'carbs' => 55,
                'fats' => 15,
                'prep_time' => 25,
                'image' => 'images/healthy.jfif',
            ],
            [
                'name' => 'Salmon with Brown Rice',
                'meal_type' => 'lunch',
                'description' => 'Baked salmon fillet served with brown rice and steamed broccoli',
                'ingredients' => '150g salmon fillet, 1 cup brown rice, broccoli, lemon, olive oil',
                'instructions' => 'Bake salmon at 180°C for 15 minutes. Serve with rice and steamed broccoli.',
                'calories' => 480,
                'protein' => 32,
                'carbs' => 45,
                'fats' => 18,
                'prep_time' => 30,
                'image' => 'images/sumit-bhatia-g7WrssBb1Ak-unsplash.jpg',
            ],

            // Snacks
            [
                'name' => 'Apple with Almond Butter',
                'meal_type' => 'snack',
                'description' => 'Crispy apple slices with creamy almond butter',
                'ingredients' => '1 apple, 2 tbsp almond butter',
                'instructions' => 'Slice apple and dip in almond butter.',
                'calories' => 180,
                'protein' => 4,
                'carbs' => 22,
                'fats' => 9,
                'prep_time' => 3,
                'image' => 'images/healthy.jfif',
            ],
            [
                'name' => 'Protein Smoothie',
                'meal_type' => 'snack',
                'description' => 'Energizing smoothie with banana, protein powder, and spinach',
                'ingredients' => '1 banana, 1 scoop protein powder, handful spinach, 1 cup almond milk',
                'instructions' => 'Blend all ingredients until smooth.',
                'calories' => 220,
                'protein' => 25,
                'carbs' => 28,
                'fats' => 3,
                'prep_time' => 5,
                'image' => 'images/healthy.jfif',
            ],
            [
                'name' => 'Hummus with Veggies',
                'meal_type' => 'snack',
                'description' => 'Homemade hummus served with fresh vegetable sticks',
                'ingredients' => '1/2 cup hummus, carrot sticks, celery, bell peppers',
                'instructions' => 'Cut vegetables into sticks and serve with hummus.',
                'calories' => 150,
                'protein' => 6,
                'carbs' => 18,
                'fats' => 7,
                'prep_time' => 5,
                'image' => 'images/healthy.jfif',
            ],

            // Dinners
            [
                'name' => 'Grilled Turkey with Vegetables',
                'meal_type' => 'dinner',
                'description' => 'Lean turkey breast with roasted seasonal vegetables',
                'ingredients' => '200g turkey breast, mixed vegetables (zucchini, bell peppers, carrots), olive oil, herbs',
                'instructions' => 'Grill turkey and roast vegetables with olive oil and herbs at 200°C for 25 minutes.',
                'calories' => 400,
                'protein' => 40,
                'carbs' => 25,
                'fats' => 15,
                'prep_time' => 35,
                'image' => 'images/healthy.jfif',
            ],
            [
                'name' => 'Vegetable Stir-Fry with Tofu',
                'meal_type' => 'dinner',
                'description' => 'Colorful vegetable stir-fry with crispy tofu and soy sauce',
                'ingredients' => '200g firm tofu, mixed vegetables, soy sauce, ginger, garlic, sesame oil',
                'instructions' => 'Pan-fry tofu until crispy. Stir-fry vegetables with seasonings, add tofu.',
                'calories' => 350,
                'protein' => 22,
                'carbs' => 30,
                'fats' => 16,
                'prep_time' => 20,
                'image' => 'images/healthy.jfif',
            ],
            [
                'name' => 'Baked Cod with Sweet Potato',
                'meal_type' => 'dinner',
                'description' => 'Delicate baked cod fillet with roasted sweet potato wedges',
                'ingredients' => '180g cod fillet, 1 large sweet potato, lemon, herbs, olive oil',
                'instructions' => 'Bake cod and sweet potato wedges at 190°C for 25 minutes with lemon and herbs.',
                'calories' => 380,
                'protein' => 35,
                'carbs' => 38,
                'fats' => 10,
                'prep_time' => 30,
                'image' => 'images/healthy.jfif',
            ],
        ];

        foreach ($recipes as $recipe) {
            Recipe::create($recipe);
        }

        // Seed Workouts
        $workouts = [
            [
                'name' => 'Morning Yoga Flow',
                'type' => 'flexibility',
                'description' => 'Gentle yoga sequence to start your day with energy and flexibility',
                'duration' => 20,
                'difficulty' => 'beginner',
                'calories_burned' => 80,
                'equipment' => 'Yoga mat',
                'instructions' => 'Follow a sequence of sun salutations, warrior poses, and stretches.',
                'image' => 'images/healthy.jfif',
            ],
            [
                'name' => 'HIIT Cardio Blast',
                'type' => 'hiit',
                'description' => 'High-intensity interval training to boost metabolism and burn fat',
                'duration' => 25,
                'difficulty' => 'intermediate',
                'calories_burned' => 300,
                'equipment' => 'None',
                'instructions' => '30 seconds work, 15 seconds rest. Exercises: jumping jacks, burpees, mountain climbers, high knees.',
                'image' => 'images/healthy.jfif',
            ],
            [
                'name' => 'Full Body Strength',
                'type' => 'strength',
                'description' => 'Complete strength training workout targeting all major muscle groups',
                'duration' => 40,
                'difficulty' => 'intermediate',
                'calories_burned' => 250,
                'equipment' => 'Dumbbells, resistance bands',
                'instructions' => '3 sets of: squats (12 reps), push-ups (10 reps), lunges (10 each leg), rows (12 reps).',
                'image' => 'images/healthy.jfif',
            ],
            [
                'name' => 'Evening Walk',
                'type' => 'cardio',
                'description' => 'Relaxing walk to unwind and maintain activity',
                'duration' => 30,
                'difficulty' => 'beginner',
                'calories_burned' => 120,
                'equipment' => 'Comfortable shoes',
                'instructions' => 'Walk at a moderate pace, maintain good posture, breathe deeply.',
                'image' => 'images/healthy.jfif',
            ],
            [
                'name' => 'Core Stability',
                'type' => 'strength',
                'description' => 'Focused core workout to build strength and stability',
                'duration' => 15,
                'difficulty' => 'beginner',
                'calories_burned' => 90,
                'equipment' => 'Yoga mat',
                'instructions' => 'Planks (30s), bicycle crunches (15 each side), leg raises (12 reps), Russian twists (20 reps).',
                'image' => 'images/healthy.jfif',
            ],
            [
                'name' => 'Dance Cardio',
                'type' => 'cardio',
                'description' => 'Fun dance-based cardio workout to get your heart pumping',
                'duration' => 30,
                'difficulty' => 'beginner',
                'calories_burned' => 200,
                'equipment' => 'None',
                'instructions' => 'Follow along to upbeat music with dance moves and cardio combinations.',
                'image' => 'images/healthy.jfif',
            ],
        ];

        foreach ($workouts as $workout) {
            Workout::create($workout);
        }

        // Seed Tips
        $tips = [
            [
                'title' => 'Stay Hydrated',
                'content' => 'Drink at least 8 glasses of water daily. Start your morning with a glass of water to kickstart your metabolism.',
                'category' => 'wellness',
            ],
            [
                'title' => 'Eat Mindfully',
                'content' => 'Take time to enjoy your meals without distractions. Chew slowly and pay attention to hunger cues.',
                'category' => 'nutrition',
            ],
            [
                'title' => 'Get Quality Sleep',
                'content' => 'Aim for 7-9 hours of sleep per night. Maintain a consistent sleep schedule and create a relaxing bedtime routine.',
                'category' => 'sleep',
            ],
            [
                'title' => 'Move Throughout the Day',
                'content' => 'Take short breaks every hour to stretch or walk. Even small movements add up to significant health benefits.',
                'category' => 'fitness',
            ],
            [
                'title' => 'Practice Gratitude',
                'content' => 'Start or end your day by writing down three things you are grateful for. This simple practice can boost mental well-being.',
                'category' => 'mental_health',
            ],
            [
                'title' => 'Prep Your Meals',
                'content' => 'Dedicate time each week to meal prep. Having healthy meals ready makes it easier to stick to your nutrition goals.',
                'category' => 'nutrition',
            ],
            [
                'title' => 'Warm Up Properly',
                'content' => 'Always warm up before exercising to prevent injuries. 5-10 minutes of light cardio and dynamic stretching is ideal.',
                'category' => 'fitness',
            ],
            [
                'title' => 'Limit Screen Time',
                'content' => 'Reduce screen time before bed to improve sleep quality. Blue light can interfere with your natural sleep cycle.',
                'category' => 'sleep',
            ],
            [
                'title' => 'Add Color to Your Plate',
                'content' => 'Eat a variety of colorful fruits and vegetables to ensure you get a wide range of nutrients and antioxidants.',
                'category' => 'nutrition',
            ],
            [
                'title' => 'Take Deep Breaths',
                'content' => 'Practice deep breathing exercises when stressed. Inhale for 4 counts, hold for 4, exhale for 4. Repeat 5 times.',
                'category' => 'mental_health',
            ],
        ];

        foreach ($tips as $tip) {
            Tip::create($tip);
        }
    }
}
