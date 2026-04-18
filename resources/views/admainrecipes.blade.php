<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Balance+ | Admin Recipes</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#0B6B7A',
                        bgBody: '#F8FAFC',
                        sidebarText: '#64748B',
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
        .nav-active {
            background-color: #F1F5F9;
            color: #0B6B7A !important;
        }
    </style>
</head>
<body class="bg-bgBody h-screen flex overflow-hidden">

    <aside class="w-64 bg-white border-r border-slate-200 flex flex-col h-full shrink-0">
        <div class="p-6">
            <h1 class="text-xl font-bold text-primary tracking-tight">Balance+</h1>
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Admin Portal</p>
        </div>

        <nav class="flex-1 px-4 space-y-1 overflow-y-auto mt-4">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 text-sidebarText hover:bg-slate-50 rounded-xl text-sm font-semibold transition-all">
                <i class="fa-solid fa-table-cells-large text-lg"></i> Dashboard
            </a>

            <div class="py-4 px-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Manage Content</div>

            <div class="space-y-1">
                <a href="{{ route('admin.recipes.index') }}" class="nav-active flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition-all">
                    <i class="fa-solid fa-utensils w-5"></i> Manage Recipes
                </a>
                <div class="pl-12 space-y-2 pb-2">
                    <a href="{{ route('admin.recipes.index', ['meal_type' => 'breakfast']) }}" class="block text-sm text-sidebarText hover:text-primary transition-colors">Breakfast</a>
                    <a href="{{ route('admin.recipes.index', ['meal_type' => 'lunch']) }}" class="block text-sm text-sidebarText hover:text-primary transition-colors">Lunch</a>
                    <a href="{{ route('admin.recipes.index', ['meal_type' => 'dinner']) }}" class="block text-sm text-sidebarText hover:text-primary transition-colors">Dinner</a>
                    <a href="{{ route('admin.recipes.index', ['meal_type' => 'snack']) }}" class="block text-sm text-sidebarText hover:text-primary transition-colors">Snack</a>
                </div>
            </div>

            <a href="{{ route('admin.workouts.index') }}" class="flex items-center gap-3 px-4 py-3 text-sidebarText hover:bg-slate-50 rounded-xl text-sm font-semibold transition-all">
                <i class="fa-solid fa-bolt-lightning w-5"></i> Manage Workouts
            </a>
            <a href="{{ route('admin.daily-plans.index') }}" class="flex items-center gap-3 px-4 py-3 text-sidebarText hover:bg-slate-50 rounded-xl text-sm font-semibold transition-all">
                <i class="fa-solid fa-calendar w-5"></i> Daily Wellness Plan
            </a>
            <a href="{{ route('admin.tips.index') }}" class="flex items-center gap-3 px-4 py-3 text-sidebarText hover:bg-slate-50 rounded-xl text-sm font-semibold transition-all">
                <i class="fa-solid fa-circle-question w-5"></i> Manage Health Tips
            </a>
            <a href="{{ route('admin.hydration.index') }}" class="flex items-center gap-3 px-4 py-3 text-sidebarText hover:bg-slate-50 rounded-xl text-sm font-semibold transition-all">
                <i class="fa-solid fa-droplet w-5"></i> Manage Drink Water
            </a>
            <a href="{{ route('admin.stories.index') }}" class="flex items-center gap-3 px-4 py-3 text-sidebarText hover:bg-slate-50 rounded-xl text-sm font-semibold transition-all">
                <i class="fa-solid fa-quote-left w-5"></i> Success Stories
                @if(isset($pendingStoriesCount) && $pendingStoriesCount > 0)
                <span class="ml-auto px-2 py-0.5 bg-red-500 text-white text-[10px] font-bold rounded-full animate-pulse">{{ $pendingStoriesCount }}</span>
                @endif
            </a>
        </nav>

        <div class="p-6 border-t border-slate-100">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center gap-3 text-red-500 font-bold text-sm hover:translate-x-1 transition-transform">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i> Log Out
                </button>
            </form>
        </div>
    </aside>

    <div class="flex-1 flex flex-col min-w-0">

        <header class="h-20 bg-white border-b border-slate-100 px-8 flex items-center justify-between shrink-0">
            <div class="relative w-96">
                <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                <input type="text" placeholder="Search..." class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 pl-11 pr-4 text-sm focus:outline-none focus:ring-2 focus:ring-primary/10 transition-all">
            </div>

            @include('admin.partials.notifications')
        </header>

  <main class="flex-1 overflow-y-auto p-10">
    <div class="max-w-6xl mx-auto text-center mb-10">
        <h2 id="currentRecipeTitle" class="text-3xl font-black text-slate-800 tracking-tight">
            @if(isset($mealType))
                {{ ucfirst($mealType) }} Recipes
            @else
                All Recipes
            @endif
        </h2>
        <p class="text-slate-400 text-sm font-medium mt-1 italic">Healthy and delicious meal recipes</p>
    </div>

    <div class="flex justify-center gap-3 mb-8 flex-wrap">
        <a href="{{ route('admin.recipes.index') }}" class="px-6 py-2 rounded-full text-xs font-bold transition-all {{ !isset($mealType) ? 'bg-primary text-white' : 'text-slate-500 hover:bg-slate-50' }}">ALL</a>
        <a href="{{ route('admin.recipes.index', ['meal_type' => 'breakfast']) }}" class="px-6 py-2 rounded-full text-xs font-bold transition-all {{ isset($mealType) && $mealType == 'breakfast' ? 'bg-primary text-white' : 'text-slate-500 hover:bg-slate-50' }}">BREAKFAST</a>
        <a href="{{ route('admin.recipes.index', ['meal_type' => 'lunch']) }}" class="px-6 py-2 rounded-full text-xs font-bold transition-all {{ isset($mealType) && $mealType == 'lunch' ? 'bg-primary text-white' : 'text-slate-500 hover:bg-slate-50' }}">LUNCH</a>
        <a href="{{ route('admin.recipes.index', ['meal_type' => 'dinner']) }}" class="px-6 py-2 rounded-full text-xs font-bold transition-all {{ isset($mealType) && $mealType == 'dinner' ? 'bg-primary text-white' : 'text-slate-500 hover:bg-slate-50' }}">DINNER</a>
        <a href="{{ route('admin.recipes.index', ['meal_type' => 'snack']) }}" class="px-6 py-2 rounded-full text-xs font-bold transition-all {{ isset($mealType) && $mealType == 'snack' ? 'bg-primary text-white' : 'text-slate-500 hover:bg-slate-50' }}">SNACK</a>
    </div>

    <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-slate-50/50 text-[10px] font-bold text-slate-400 uppercase tracking-widest border-b border-slate-100">
                    <th class="px-8 py-6">Meal</th>
                    <th class="px-8 py-6">Meal Type</th>
                    <th class="px-8 py-6">Nutrition Profile</th>
                    <th class="px-8 py-6">Energy</th>
                    <th class="px-8 py-6 text-right">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recipes as $recipe)
                <tr class="hover:bg-slate-50/50 transition-colors group border-b border-slate-50 last:border-0">
                    <td class="px-8 py-5">
                        <div class="flex items-center gap-4">
                            <div class="w-14 h-14 rounded-2xl overflow-hidden shadow-sm border border-slate-100 group-hover:scale-105 transition-transform">
                                @if($recipe->image)
                                    <img src="{{ asset($recipe->image) }}" alt="{{ $recipe->name }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center
                                        @if($recipe->meal_type == 'breakfast') bg-yellow-50 text-yellow-500
                                        @elseif($recipe->meal_type == 'lunch') bg-green-50 text-green-500
                                        @elseif($recipe->meal_type == 'dinner') bg-blue-50 text-blue-500
                                        @else bg-pink-50 text-pink-500
                                        @endif">
                                        <i class="fa-solid fa-utensils text-xl"></i>
                                    </div>
                                @endif
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-900 text-sm">{{ $recipe->name }}</h4>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-5">
                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800 capitalize">
                            {{ $recipe->meal_type }}
                        </span>
                    </td>
                    <td class="px-8 py-5">
                        <div class="text-xs text-gray-600 font-medium">
                            Prot: {{ $recipe->protein ?? '0' }}g | Carbs: {{ $recipe->carbs ?? '0' }}g | Fats: {{ $recipe->fats ?? '0' }}g
                        </div>
                    </td>
                    <td class="px-8 py-5">
                        <span class="px-3 py-1 bg-emerald-50 text-emerald-600 rounded-full text-xs font-black uppercase">{{ $recipe->calories ?? 'N/A' }} kcal</span>
                    </td>
                    <td class="px-8 py-5">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('admin.recipes.edit', $recipe->id) }}" class="w-8 h-8 flex items-center justify-center rounded-lg border border-slate-100 text-slate-400 hover:text-primary transition-all">
                                <i class="fa-solid fa-pen text-[10px]"></i>
                            </a>
                            <form action="{{ route('admin.recipes.destroy', $recipe->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this recipe?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-8 h-8 flex items-center justify-center rounded-lg bg-red-50 text-red-500 hover:bg-red-500 hover:text-white transition-all">
                                    <i class="fa-solid fa-trash text-[10px]"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-8 py-12 text-center text-slate-400">
                        <i class="fa-solid fa-utensils text-4xl mb-3"></i>
                        <p class="font-semibold">No recipes found</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="flex justify-center mt-12 pb-10">
            <a href="{{ route('admin.recipes.create') }}" class="bg-primary text-white px-12 py-4 rounded-[1.5rem] font-bold text-[12px] uppercase tracking-[0.15em] shadow-2xl shadow-primary/30 hover:-translate-y-1 active:scale-95 transition-all flex items-center gap-3">
                <div class="bg-white/20 w-6 h-6 rounded-full flex items-center justify-center">
                    <i class="fa-solid fa-plus text-[10px]"></i>
                </div>
                Add New Recipe
            </a>
        </div>
    </div>
</main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </body>
</html>
