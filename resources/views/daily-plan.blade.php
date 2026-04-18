@extends('layouts.app')

@section('title', 'Daily Wellness Plan | Balance+')

@section('content')
<section class="py-16">
    <div class="container mx-auto px-4 max-w-6xl">

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
            <div class="lg:col-span-8 space-y-8">
                <div class="flex justify-between items-end mb-4">
                    <div>
                        <h2 class="text-3xl font-black text-slate-800 tracking-tight">Daily Wellness Plan</h2>
                        <p class="text-slate-400 text-xs font-medium">
                            Your personalized plan for {{ \Carbon\Carbon::parse($todayPlan->plan_date)->format('l, F j, Y') }}
                        </p>
                    </div>
                    <button onclick="regeneratePlan()" class="text-[#0B6B7A] text-xs font-bold hover:underline italic transition">
                        Regenerate Plan
                    </button>
                </div>

                <!-- Goal-Based Message -->
                @if(auth()->user()->health_goal)
                <div class="bg-gradient-to-r from-primary/10 to-accent/10 rounded-2xl p-4 border border-primary/20">
                    <div class="flex items-center gap-3">
                        <div class="text-3xl">
                            @if(auth()->user()->health_goal == 'lose_weight')
                                🏃‍♂️
                            @elseif(auth()->user()->health_goal == 'gain_weight')
                                💪
                            @elseif(auth()->user()->health_goal == 'build_muscle')
                                🏋️
                            @else
                                ⚖️
                            @endif
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-slate-800">Customized plan for {{ auth()->user()->getGoalInArabic() }}</h3>
                            <p class="text-xs text-slate-600">
                                @if(auth()->user()->health_goal == 'lose_weight')
                                    Low-calorie recipes selected to help you lose weight
                                @elseif(auth()->user()->health_goal == 'gain_weight')
                                    High-calorie recipes selected to help you gain weight
                                @elseif(auth()->user()->health_goal == 'build_muscle')
                                    High-protein recipes selected for muscle building
                                @else
                                    Balanced recipes selected to maintain your weight
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Meals Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6" id="mealsGrid">
                    <!-- Breakfast -->
                    @if($todayPlan->breakfast)
                    <div class="meal-card bg-white rounded-3xl border-2 border-slate-200 shadow-md overflow-hidden group hover:shadow-xl hover:border-[#0B6B7A] transition-all duration-300">
                        <div class="h-40 overflow-hidden relative">
                            <img src="{{ asset($todayPlan->breakfast->image ?? 'images/healthy.jfif') }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
                            <div class="absolute bottom-3 left-4">
                                <span class="bg-[#0B6B7A] text-white px-3 py-1 rounded-full text-xs font-bold">Breakfast</span>
                            </div>
                        </div>
                        <div class="p-5">
                            <p class="text-lg font-bold text-slate-800 mb-2">{{ $todayPlan->breakfast->name }}</p>
                            <p class="text-xs text-slate-500 leading-relaxed mb-4">
                                {{ Str::limit($todayPlan->breakfast->description, 80) }}
                            </p>
                            <div class="flex gap-4 text-xs text-slate-600 mb-4">
                                <span><i class="fa-solid fa-fire text-orange-500"></i> {{ $todayPlan->breakfast->calories }}cal</span>
                                <span><i class="fa-solid fa-clock text-[#0B6B7A]"></i> {{ $todayPlan->breakfast->prep_time }}min</span>
                            </div>
                            <button onclick="showRecipe({{ $todayPlan->breakfast->id }}, 'breakfast')"
                                class="w-full py-2.5 bg-[#0B6B7A] rounded-xl text-white text-xs font-bold hover:bg-[#094d57] transition-all">
                                View Recipe
                            </button>
                        </div>
                    </div>
                    @endif

                    <!-- Lunch -->
                    @if($todayPlan->lunch)
                    <div class="meal-card bg-white rounded-3xl border-2 border-slate-200 shadow-md overflow-hidden group hover:shadow-xl hover:border-[#0B6B7A] transition-all duration-300">
                        <div class="h-40 overflow-hidden relative">
                            <img src="{{ asset($todayPlan->lunch->image ?? 'images/healthy.jfif') }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
                            <div class="absolute bottom-3 left-4">
                                <span class="bg-[#0B6B7A] text-white px-3 py-1 rounded-full text-xs font-bold">Lunch</span>
                            </div>
                        </div>
                        <div class="p-5">
                            <p class="text-lg font-bold text-slate-800 mb-2">{{ $todayPlan->lunch->name }}</p>
                            <p class="text-xs text-slate-500 leading-relaxed mb-4">
                                {{ Str::limit($todayPlan->lunch->description, 80) }}
                            </p>
                            <div class="flex gap-4 text-xs text-slate-600 mb-4">
                                <span><i class="fa-solid fa-fire text-orange-500"></i> {{ $todayPlan->lunch->calories }}cal</span>
                                <span><i class="fa-solid fa-clock text-[#0B6B7A]"></i> {{ $todayPlan->lunch->prep_time }}min</span>
                            </div>
                            <button onclick="showRecipe({{ $todayPlan->lunch->id }}, 'lunch')"
                                class="w-full py-2.5 bg-[#0B6B7A] rounded-xl text-white text-xs font-bold hover:bg-[#094d57] transition-all">
                                View Recipe
                            </button>
                        </div>
                    </div>
                    @endif

                    <!-- Snack -->
                    @if($todayPlan->snack)
                    <div class="meal-card bg-white rounded-3xl border-2 border-slate-200 shadow-md overflow-hidden group hover:shadow-xl hover:border-[#0B6B7A] transition-all duration-300">
                        <div class="h-40 overflow-hidden relative">
                            <img src="{{ asset($todayPlan->snack->image ?? 'images/healthy.jfif') }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
                            <div class="absolute bottom-3 left-4">
                                <span class="bg-[#0B6B7A] text-white px-3 py-1 rounded-full text-xs font-bold">Snack</span>
                            </div>
                        </div>
                        <div class="p-5">
                            <p class="text-lg font-bold text-slate-800 mb-2">{{ $todayPlan->snack->name }}</p>
                            <p class="text-xs text-slate-500 leading-relaxed mb-4">
                                {{ Str::limit($todayPlan->snack->description, 80) }}
                            </p>
                            <div class="flex gap-4 text-xs text-slate-600 mb-4">
                                <span><i class="fa-solid fa-fire text-orange-500"></i> {{ $todayPlan->snack->calories }}cal</span>
                                <span><i class="fa-solid fa-clock text-[#0B6B7A]"></i> {{ $todayPlan->snack->prep_time }}min</span>
                            </div>
                            <button onclick="showRecipe({{ $todayPlan->snack->id }}, 'snack')"
                                class="w-full py-2.5 bg-[#0B6B7A] rounded-xl text-white text-xs font-bold hover:bg-[#094d57] transition-all">
                                View Recipe
                            </button>
                        </div>
                    </div>
                    @endif

                    <!-- Dinner -->
                    @if($todayPlan->dinner)
                    <div class="meal-card bg-white rounded-3xl border-2 border-slate-200 shadow-md overflow-hidden group hover:shadow-xl hover:border-[#0B6B7A] transition-all duration-300">
                        <div class="h-40 overflow-hidden relative">
                            <img src="{{ asset($todayPlan->dinner->image ?? 'images/healthy.jfif') }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
                            <div class="absolute bottom-3 left-4">
                                <span class="bg-[#0B6B7A] text-white px-3 py-1 rounded-full text-xs font-bold">Dinner</span>
                            </div>
                        </div>
                        <div class="p-5">
                            <p class="text-lg font-bold text-slate-800 mb-2">{{ $todayPlan->dinner->name }}</p>
                            <p class="text-xs text-slate-500 leading-relaxed mb-4">
                                {{ Str::limit($todayPlan->dinner->description, 80) }}
                            </p>
                            <div class="flex gap-4 text-xs text-slate-600 mb-4">
                                <span><i class="fa-solid fa-fire text-orange-500"></i> {{ $todayPlan->dinner->calories }}cal</span>
                                <span><i class="fa-solid fa-clock text-[#0B6B7A]"></i> {{ $todayPlan->dinner->prep_time }}min</span>
                            </div>
                            <button onclick="showRecipe({{ $todayPlan->dinner->id }}, 'dinner')"
                                class="w-full py-2.5 bg-[#0B6B7A] rounded-xl text-white text-xs font-bold hover:bg-[#094d57] transition-all">
                                View Recipe
                            </button>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Daily Workout -->
                @if($todayPlan->workout)
                <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="font-black text-slate-800">Daily Workout</h3>
                        <i class="fa-solid fa-bolt-lightning text-yellow-400/40"></i>
                    </div>
                    <div class="flex flex-col md:flex-row gap-8 items-center">
                        <div class="w-full md:w-56 h-36 rounded-3xl overflow-hidden shadow-inner flex items-center justify-center"
                            style="background: linear-gradient(135deg, {{ $todayPlan->workout->difficulty == 'beginner' ? '#e0f2fe, #bae6fd' : ($todayPlan->workout->difficulty == 'intermediate' ? '#fed7aa, #fdba74' : '#fecaca, #fca5a5') }})">
                            <span class="text-6xl">
                                @if($todayPlan->workout->type == 'cardio')
                                    🏃
                                @elseif($todayPlan->workout->type == 'strength')
                                    🏋️
                                @elseif($todayPlan->workout->type == 'flexibility')
                                    🧘
                                @elseif($todayPlan->workout->type == 'hiit')
                                    🔥
                                @else
                                    💪
                                @endif
                            </span>
                        </div>
                        <div class="flex-1 text-center md:text-left">
                            <h4 class="text-xl font-black text-slate-800 mb-2">{{ $todayPlan->workout->name }}</h4>
                            <p class="text-xs text-slate-500 leading-relaxed mb-4 font-medium">
                                {{ Str::limit($todayPlan->workout->description, 100) }}
                            </p>
                            <div class="flex gap-4 text-xs text-slate-400 mb-6 justify-center md:justify-start">
                                <span><i class="fa-solid fa-clock"></i> {{ $todayPlan->workout->duration }}min</span>
                                <span><i class="fa-solid fa-fire text-orange-400"></i> {{ $todayPlan->workout->calories_burned }}cal</span>
                                <span class="capitalize"><i class="fa-solid fa-signal"></i> {{ $todayPlan->workout->difficulty }}</span>
                            </div>
                            <button onclick="showWorkout()"
                                class="w-full md:w-auto px-10 py-4 bg-[#0B6B7A] text-white rounded-2xl font-black text-[10px] uppercase tracking-widest hover:shadow-lg hover:bg-[#094d57] transition-all active:scale-95">
                                Start Workout
                            </button>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-4 space-y-8">
                <!-- Hydration Tracker -->
                <div class="bg-white p-8 rounded-[2.5rem] border border-slate-50 shadow-sm text-center">
                    <div class="flex justify-between items-center mb-8">
                        <h3 class="font-black text-slate-800 text-sm uppercase tracking-wider">Hydration</h3>
                        <i class="fa-solid fa-droplet text-cyan-400 text-xs"></i>
                    </div>

                    <div class="mb-8">
                        <div class="flex items-baseline justify-center gap-1">
                            <span id="waterCount" class="text-6xl font-black text-slate-900 tracking-tighter">0</span>
                            <span class="text-slate-300 text-lg font-bold">/8</span>
                        </div>
                        <p class="text-[10px] font-black text-cyan-500 uppercase tracking-[0.2em] mt-2">Cups Today</p>
                    </div>

                    <div class="grid grid-cols-4 gap-6" id="newCupsContainer"></div>

                    <p class="text-[10px] text-slate-300 mt-8 italic font-medium">Tap each cup as you drink</p>
                </div>

                <!-- Health Tip -->
                @if($todayPlan->tip)
                <div class="bg-amber-50/50 p-8 rounded-[2.5rem] border border-amber-100/50">
                    <div class="w-10 h-10 bg-amber-100 rounded-2xl flex items-center justify-center text-amber-600 mb-4 shadow-sm">
                        <i class="fa-solid fa-lightbulb text-sm"></i>
                    </div>
                    <h4 class="font-black text-slate-800 text-xs mb-2 uppercase tracking-wide">{{ $todayPlan->tip->title }}</h4>
                    <p class="text-[11px] text-slate-500 leading-relaxed font-medium">{{ $todayPlan->tip->content }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Workout data
    const workoutData = {
        name: "{{ $todayPlan->workout->name ?? 'N/A' }}",
        description: "{{ $todayPlan->workout->description ?? 'No description' }}",
        duration: "{{ $todayPlan->workout->duration ?? 'N/A' }}",
        calories: "{{ $todayPlan->workout->calories_burned ?? 'N/A' }}",
        equipment: "{{ $todayPlan->workout->equipment ?? 'No equipment needed' }}",
        instructions: "{{ $todayPlan->workout->instructions ?? 'Follow along with the workout routine.' }}",
        videoUrl: "{{ $todayPlan->workout->video_url ?? '' }}"
    };

    // Recipe data for all meals
    const recipesData = {
        breakfast: {
            name: "{{ $todayPlan->breakfast->name ?? 'N/A' }}",
            image: "{{ asset($todayPlan->breakfast->image ?? 'images/healthy.jfif') }}",
            description: "{{ $todayPlan->breakfast->description ?? 'No description' }}",
            ingredients: {!! json_encode($todayPlan->breakfast->ingredients ?? 'No ingredients listed') !!},
            instructions: {!! json_encode($todayPlan->breakfast->instructions ?? 'No instructions') !!},
            calories: "{{ $todayPlan->breakfast->calories ?? 'N/A' }}",
            protein: "{{ $todayPlan->breakfast->protein ?? 'N/A' }}",
            carbs: "{{ $todayPlan->breakfast->carbs ?? 'N/A' }}",
            fats: "{{ $todayPlan->breakfast->fats ?? 'N/A' }}",
            prep_time: "{{ $todayPlan->breakfast->prep_time ?? 'N/A' }}"
        },
        lunch: {
            name: "{{ $todayPlan->lunch->name ?? 'N/A' }}",
            image: "{{ asset($todayPlan->lunch->image ?? 'images/healthy.jfif') }}",
            description: "{{ $todayPlan->lunch->description ?? 'No description' }}",
            ingredients: {!! json_encode($todayPlan->lunch->ingredients ?? 'No ingredients listed') !!},
            instructions: {!! json_encode($todayPlan->lunch->instructions ?? 'No instructions') !!},
            calories: "{{ $todayPlan->lunch->calories ?? 'N/A' }}",
            protein: "{{ $todayPlan->lunch->protein ?? 'N/A' }}",
            carbs: "{{ $todayPlan->lunch->carbs ?? 'N/A' }}",
            fats: "{{ $todayPlan->lunch->fats ?? 'N/A' }}",
            prep_time: "{{ $todayPlan->lunch->prep_time ?? 'N/A' }}"
        },
        snack: {
            name: "{{ $todayPlan->snack->name ?? 'N/A' }}",
            image: "{{ asset($todayPlan->snack->image ?? 'images/healthy.jfif') }}",
            description: "{{ $todayPlan->snack->description ?? 'No description' }}",
            ingredients: {!! json_encode($todayPlan->snack->ingredients ?? 'No ingredients listed') !!},
            instructions: {!! json_encode($todayPlan->snack->instructions ?? 'No instructions') !!},
            calories: "{{ $todayPlan->snack->calories ?? 'N/A' }}",
            protein: "{{ $todayPlan->snack->protein ?? 'N/A' }}",
            carbs: "{{ $todayPlan->snack->carbs ?? 'N/A' }}",
            fats: "{{ $todayPlan->snack->fats ?? 'N/A' }}",
            prep_time: "{{ $todayPlan->snack->prep_time ?? 'N/A' }}"
        },
        dinner: {
            name: "{{ $todayPlan->dinner->name ?? 'N/A' }}",
            image: "{{ asset($todayPlan->dinner->image ?? 'images/healthy.jfif') }}",
            description: "{{ $todayPlan->dinner->description ?? 'No description' }}",
            ingredients: {!! json_encode($todayPlan->dinner->ingredients ?? 'No ingredients listed') !!},
            instructions: {!! json_encode($todayPlan->dinner->instructions ?? 'No instructions') !!},
            calories: "{{ $todayPlan->dinner->calories ?? 'N/A' }}",
            protein: "{{ $todayPlan->dinner->protein ?? 'N/A' }}",
            carbs: "{{ $todayPlan->dinner->carbs ?? 'N/A' }}",
            fats: "{{ $todayPlan->dinner->fats ?? 'N/A' }}",
            prep_time: "{{ $todayPlan->dinner->prep_time ?? 'N/A' }}"
        }
    };

    // Hydration Tracker
    let waterCount = 0;
    const maxCups = 8;
    const waterCountEl = document.getElementById('waterCount');
    const cupsContainer = document.getElementById('newCupsContainer');

    // Initialize cups
    for (let i = 0; i < maxCups; i++) {
        const cup = document.createElement('div');
        cup.className = 'w-6 h-8 rounded-lg border-2 border-cyan-200 flex items-end overflow-hidden cursor-pointer transition-all hover:border-cyan-400';
        cup.innerHTML = '<div class="w-full bg-cyan-400 transition-all duration-300" style="height: 0%"></div>';
        cup.onclick = () => fillCup(i);
        cupsContainer.appendChild(cup);
    }

    function fillCup(index) {
        const cups = cupsContainer.children;

        if (index < waterCount) {
            waterCount = index;
        } else {
            waterCount = index + 1;
        }

        for (let i = 0; i < maxCups; i++) {
            const fill = cups[i].querySelector('div');
            if (i < waterCount) {
                fill.style.height = '100%';
            } else {
                fill.style.height = '0%';
            }
        }

        waterCountEl.textContent = waterCount;
        localStorage.setItem('waterCount_' + new Date().toLocaleDateString(), waterCount);

        // Celebrate when goal is reached
        if (waterCount === maxCups) {
            Swal.fire({
                icon: 'success',
                title: '🎉 Hydration Goal Reached!',
                text: 'Great job! You drank 8 cups of water today.',
                confirmButtonColor: '#0B6B7A'
            });
        }
    }

    // Load saved water count for today
    const savedCount = localStorage.getItem('waterCount_' + new Date().toLocaleDateString());
    if (savedCount) {
        fillCup(parseInt(savedCount) - 1);
    }

    // Show Recipe Modal
    function showRecipe(recipeId, mealType) {
        const recipe = recipesData[mealType];

        Swal.fire({
            title: '',
            html: `
                <div style="border: 3px solid #e2e8f0; border-radius: 1rem; background: white; overflow: hidden;">
                    <!-- Recipe Header with Image -->
                    <div style="position: relative; height: 140px; overflow: hidden;">
                        <img src="${recipe.image}" alt="${recipe.name}" style="width: 100%; height: 100%; object-fit: cover;">
                        <div style="position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(to top, rgba(0,0,0,0.7), transparent); padding: 0.75rem 1rem;">
                            <h2 style="color: white; font-size: 1.2rem; font-weight: 800; margin: 0; text-shadow: 0 2px 4px rgba(0,0,0,0.3);">${recipe.name}</h2>
                        </div>
                    </div>

                    <div style="padding: 1rem;">
                        <!-- Description -->
                        <p style="color: #64748b; font-size: 0.75rem; line-height: 1.4; text-align: center; margin: 0 0 0.75rem 0; padding-bottom: 0.75rem; border-bottom: 1px solid #e2e8f0;">${recipe.description}</p>

                        <!-- Ingredients -->
                        <div style="background: #f8fafc; border: 2px solid #cbd5e1; border-radius: 0.65rem; padding: 0.65rem; margin-bottom: 0.65rem;">
                            <h3 style="color: #0B6B7A; font-size: 0.8rem; font-weight: 700; margin: 0 0 0.4rem 0; display: flex; align-items: center; gap: 0.3rem;">
                                <i class="fa-solid fa-list-check" style="font-size: 0.75rem;"></i> Ingredients
                            </h3>
                            <ul style="color: #475569; font-size: 0.7rem; line-height: 1.5; margin: 0; padding-left: 1rem; list-style-type: disc;">
                                ${recipe.ingredients.split(',').map(item => `<li style="margin-bottom: 0.2rem;">${item.trim()}</li>`).join('')}
                            </ul>
                        </div>

                        <!-- Prep Time -->
                        <div style="background: #f1f5f9; border: 2px solid #cbd5e1; border-radius: 0.65rem; padding: 0.5rem; text-align: center; margin-bottom: 0.65rem;">
                            <i class="fa-solid fa-clock" style="color: #0B6B7A; font-size: 0.85rem;"></i>
                            <span style="color: #475569; font-weight: 600; margin-left: 0.3rem; font-size: 0.7rem;">${recipe.prep_time} min</span>
                        </div>

                        <!-- Nutrition Facts -->
                        <div style="background: #e2e8f0; border: 2px solid #cbd5e1; border-radius: 0.65rem; padding: 0.6rem; margin-top: 0.65rem;">
                            <h3 style="color: #334155; font-size: 0.8rem; font-weight: 700; margin: 0 0 0.4rem 0; text-align: center;">
                                <i class="fa-solid fa-chart-pie" style="color: #0B6B7A; font-size: 0.75rem;"></i> Nutrition Facts
                            </h3>
                            <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 0.45rem;">
                                <div style="background: white; padding: 0.5rem; border-radius: 0.5rem; text-align: center; border: 2px solid #cbd5e1;">
                                    <i class="fa-solid fa-fire" style="color: #f97316; font-size: 1rem;"></i>
                                    <p style="font-size: 0.6rem; color: #64748b; font-weight: 700; text-transform: uppercase; margin: 0.15rem 0;">Cal</p>
                                    <p style="font-weight: 900; color: #1e293b; font-size: 0.85rem; margin: 0;">${recipe.calories}</p>
                                </div>
                                <div style="background: white; padding: 0.5rem; border-radius: 0.5rem; text-align: center; border: 2px solid #cbd5e1;">
                                    <i class="fa-solid fa-drumstick-bite" style="color: #dc2626; font-size: 1rem;"></i>
                                    <p style="font-size: 0.6rem; color: #64748b; font-weight: 700; text-transform: uppercase; margin: 0.15rem 0;">Pro</p>
                                    <p style="font-weight: 900; color: #1e293b; font-size: 0.85rem; margin: 0;">${recipe.protein}g</p>
                                </div>
                                <div style="background: white; padding: 0.5rem; border-radius: 0.5rem; text-align: center; border: 2px solid #cbd5e1;">
                                    <i class="fa-solid fa-wheat-awn" style="color: #ca8a04; font-size: 1rem;"></i>
                                    <p style="font-size: 0.6rem; color: #64748b; font-weight: 700; text-transform: uppercase; margin: 0.15rem 0;">Carbs</p>
                                    <p style="font-weight: 900; color: #1e293b; font-size: 0.85rem; margin: 0;">${recipe.carbs}g</p>
                                </div>
                                <div style="background: white; padding: 0.5rem; border-radius: 0.5rem; text-align: center; border: 2px solid #cbd5e1;">
                                    <i class="fa-solid fa-droplet" style="color: #eab308; font-size: 1rem;"></i>
                                    <p style="font-size: 0.6rem; color: #64748b; font-weight: 700; text-transform: uppercase; margin: 0.15rem 0;">Fats</p>
                                    <p style="font-weight: 900; color: #1e293b; font-size: 0.85rem; margin: 0;">${recipe.fats}g</p>
                                </div>
                            </div>
                        </div>

                        <!-- Back to Menu Button -->
                        <div style="text-align: center; margin-top: 0.75rem;">
                            <button onclick="Swal.close()" style="background: #0B6B7A; color: white; padding: 0.55rem 1.75rem; border-radius: 0.6rem; border: none; font-weight: 700; font-size: 0.75rem; cursor: pointer; transition: all 0.3s; box-shadow: 0 2px 4px rgba(11, 107, 122, 0.2);" onmouseover="this.style.background='#094d56'" onmouseout="this.style.background='#0B6B7A'">
                                <i class="fa-solid fa-arrow-left" style="margin-right: 0.35rem;"></i>Back to Menu
                            </button>
                        </div>
                    </div>
                </div>
            `,
            width: 580,
            showConfirmButton: false,
            customClass: {
                popup: 'swal-wide',
                htmlContainer: 'swal-no-padding'
            }
        });
    }

    // Show Workout Modal
    function showWorkout() {
        const videoUrl = workoutData.videoUrl;

        Swal.fire({
            title: `<strong class="text-primary">${workoutData.name}</strong>`,
            html: `
                <div class="text-left space-y-4">
                    <p class="text-sm text-slate-600 italic">${workoutData.description}</p>

                    <div class="grid grid-cols-2 gap-4 p-4 bg-slate-50 rounded-2xl">
                        <div class="text-center">
                            <i class="fa-regular fa-clock text-primary text-xl mb-2"></i>
                            <p class="text-xs text-slate-400 font-bold uppercase">Duration</p>
                            <p class="text-lg font-black text-slate-800">${workoutData.duration} min</p>
                        </div>
                        <div class="text-center">
                            <i class="fa-solid fa-fire text-orange-500 text-xl mb-2"></i>
                            <p class="text-xs text-slate-400 font-bold uppercase">Calories</p>
                            <p class="text-lg font-black text-slate-800">${workoutData.calories} kcal</p>
                        </div>
                    </div>

                    <div class="p-4 bg-[#0B6B7A]/5 rounded-2xl">
                        <div class="flex items-center gap-2 mb-2">
                            <i class="fa-solid fa-dumbbell text-primary"></i>
                            <p class="text-xs font-bold text-slate-700 uppercase">Equipment Needed</p>
                        </div>
                        <p class="text-sm text-slate-600">${workoutData.equipment}</p>
                    </div>

                    <div class="p-4 bg-[#0B6B7A]/5 rounded-2xl">
                        <div class="flex items-center gap-2 mb-2">
                            <i class="fa-solid fa-list-check text-primary"></i>
                            <p class="text-xs font-bold text-slate-700 uppercase">Instructions</p>
                        </div>
                        <p class="text-sm text-slate-600 leading-relaxed">${workoutData.instructions}</p>
                    </div>

                    ${videoUrl ? `
                    <div class="mt-6 p-4 bg-gradient-to-r from-red-50 to-pink-50 rounded-2xl text-center border-2 border-red-100">
                        <i class="fa-brands fa-youtube text-red-600 text-3xl mb-2"></i>
                        <p class="text-xs text-slate-600 mb-2">Follow along with the video tutorial</p>
                    </div>
                    ` : `
                    <div class="mt-6 p-4 border-2 border-dashed border-slate-200 rounded-2xl text-center">
                        <p class="text-xs text-slate-400">Ready to begin? Let's get moving! 💪</p>
                    </div>
                    `}
                </div>
            `,
            width: 700,
            confirmButtonColor: '#0B6B7A',
            confirmButtonText: videoUrl ? '<i class="fa-solid fa-play mr-2"></i> Watch on YouTube' : '<i class="fa-solid fa-dumbbell mr-2"></i> Start Workout',
            showCancelButton: true,
            cancelButtonText: 'Close',
            cancelButtonColor: '#94A3B8'
        }).then((result) => {
            if (result.isConfirmed && videoUrl) {
                window.open(videoUrl, '_blank');
            }
        });
    }

    // Regenerate Plan
    async function regeneratePlan() {
        const result = await Swal.fire({
            title: 'Regenerate Plan?',
            text: 'This will create a new random plan for today. Continue?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#0B6B7A',
            cancelButtonColor: '#94A3B8',
            confirmButtonText: 'Yes, regenerate!',
            cancelButtonText: 'Cancel'
        });

        if (result.isConfirmed) {
            try {
                const response = await fetch('{{ route("daily-plan.regenerate") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        date: new Date().toISOString().split('T')[0]
                    })
                });

                const data = await response.json();

                if (data.success) {
                    await Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Your daily plan has been regenerated!',
                        confirmButtonColor: '#0B6B7A'
                    });
                    window.location.reload();
                } else {
                    throw new Error(data.message || 'Failed to regenerate plan');
                }
            } catch (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed to regenerate plan. Please try again.',
                    confirmButtonColor: '#0B6B7A'
                });
            }
        }
    }
</script>

<style>
    .swal-no-padding .swal2-html-container {
        padding: 0 !important;
        margin: 0 !important;
        overflow: visible !important;
    }
</style>
@endsection
