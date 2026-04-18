<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Balance+ | Admin Dashborad</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
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

        body {
            font-family: 'Inter', sans-serif;
        }

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
            <a href="{{ route('admin.dashboard') }}"
                class="nav-active flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition-all">

                <i class="fa-solid fa-table-cells-large text-lg"></i> Dashboard
            </a>

            <div class="py-4 px-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Manage Content</div>

            <div class="space-y-1">
                <!-- <a href="#" class="nav-active flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition-all"> -->

                <a href="{{ route('admin.recipes.index') }}"
                    class="flex items-center gap-3 px-4 py-3 text-sidebarText hover:bg-slate-50 rounded-xl text-sm font-semibold transition-all">
                    <i class="fa-solid fa-utensils w-5"></i> Manage Recipes
                </a>
                <div class="pl-12 space-y-2 pb-2">
                    <a href="{{ route('admin.recipes.index', ['meal_type' => 'breakfast']) }}"
                        class="block text-sm text-sidebarText hover:text-primary transition-colors">Breakfast</a>
                    <a href="{{ route('admin.recipes.index', ['meal_type' => 'lunch']) }}"
                        class="block text-sm text-sidebarText hover:text-primary transition-colors">Lunch</a>
                    <a href="{{ route('admin.recipes.index', ['meal_type' => 'dinner']) }}"
                        class="block text-sm text-sidebarText hover:text-primary transition-colors">Dinner</a>
                    <a href="{{ route('admin.recipes.index', ['meal_type' => 'snack']) }}"
                        class="block text-sm text-sidebarText hover:text-primary transition-colors">Snack</a>
                </div>
            </div>

            <a href="{{ route('admin.workouts.index') }}"
                class="flex items-center gap-3 px-4 py-3 text-sidebarText hover:bg-slate-50 rounded-xl text-sm font-semibold transition-all">
                <i class="fa-solid fa-bolt-lightning w-5"></i> Manage Workouts
            </a>
            <a href="{{ route('admin.daily-plans.index') }}"
                class="flex items-center gap-3 px-4 py-3 text-sidebarText hover:bg-slate-50 rounded-xl text-sm font-semibold transition-all">
                <i class="fa-solid fa-calendar w-5"></i> Daily Wellness Plan
            </a>
            <a href="{{ route('admin.tips.index') }}"
                class="flex items-center gap-3 px-4 py-3 text-sidebarText hover:bg-slate-50 rounded-xl text-sm font-semibold transition-all">
                <i class="fa-solid fa-circle-question w-5"></i> Manage Health Tips
            </a>
            <a href="{{ route('admin.hydration.index') }}"
                class="flex items-center gap-3 px-4 py-3 text-sidebarText hover:bg-slate-50 rounded-xl text-sm font-semibold transition-all">
                <i class="fa-solid fa-droplet w-5"></i> Manage Drink Water
            </a>
            <a href="{{ route('admin.stories.index') }}"
                class="flex items-center gap-3 px-4 py-3 text-sidebarText hover:bg-slate-50 rounded-xl text-sm font-semibold transition-all">
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

    <div class="flex-1 flex flex-col min-w-0 bg-[#F8FAFC]">

        <header class="h-20 bg-white border-b border-slate-100 px-8 flex items-center justify-between shrink-0">
            <div class="relative w-96">
                <i
                    class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                <input type="text" placeholder="Search..."
                    class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 pl-11 pr-4 text-sm focus:outline-none focus:ring-2 focus:ring-primary/10 transition-all">
            </div>

            @include('admin.partials.notifications')
        </header>

        <main class="flex-1 overflow-y-auto p-8 space-y-10">

            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-6">

                <div
                    class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 bg-blue-50 text-blue-500 rounded-2xl flex items-center justify-center mb-4">
                        <i class="fa-solid fa-users text-xl"></i>
                    </div>
                    <div class="text-2xl font-black text-slate-800">{{ $stats['users'] }}</div>
                    <div class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mt-1">Total Users</div>
                </div>

                <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm">
                    <div class="w-12 h-12 bg-amber-50 text-amber-500 rounded-2xl flex items-center justify-center mb-4">
                        <i class="fa-solid fa-lightbulb text-xl"></i>
                    </div>
                    <div class="text-2xl font-black text-slate-800">{{ $stats['tips'] }}</div>
                    <div class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mt-1">Total Tips</div>
                </div>

                <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm">
                    <div class="w-12 h-12 bg-rose-50 text-rose-500 rounded-2xl flex items-center justify-center mb-4">
                        <i class="fa-solid fa-heart-pulse text-xl"></i>
                    </div>
                    <div class="text-2xl font-black text-slate-800">{{ $stats['workouts'] }}</div>
                    <div class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mt-1">Workouts</div>
                </div>

                <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm">
                    <div
                        class="w-12 h-12 bg-emerald-50 text-emerald-500 rounded-2xl flex items-center justify-center mb-4">
                        <i class="fa-solid fa-utensils text-xl"></i>
                    </div>
                    <div class="text-2xl font-black text-slate-800">{{ $stats['recipes'] }}</div>
                    <div class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mt-1">Total Recipes</div>
                </div>

                <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm">
                    <div
                        class="w-12 h-12 bg-indigo-50 text-indigo-500 rounded-2xl flex items-center justify-center mb-4">
                        <i class="fa-solid fa-calendar-check text-xl"></i>
                    </div>
                    <div class="text-2xl font-black text-slate-800">{{ $stats['daily_plans'] }}</div>
                    <div class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mt-1">Daily Plans</div>
                </div>

            </div>

            <div class="space-y-6 pb-10">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-black text-slate-800 tracking-tight">Latest Registered Users</h2>
                    <button
                        class="text-[11px] font-bold text-primary uppercase tracking-widest hover:underline decoration-2 underline-offset-4 transition-all">
                        View All Users
                    </button>
                </div>

                <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden">
                    <table class="w-full text-left">
                        <thead>
                            <tr
                                class="bg-slate-50/50 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-100">
                                <th class="px-8 py-6">Name</th>
                                <th class="px-8 py-6">Gmail</th>
                                <th class="px-8 py-6">Registered Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @forelse($latestUsers as $user)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-8 py-5 font-bold text-slate-700">{{ $user->name }}</td>
                                <td class="px-8 py-5 text-slate-500 text-sm italic underline decoration-slate-200">
                                    {{ $user->email }}</td>
                                <td class="px-8 py-5">
                                    @if($user->created_at->isToday())
                                        <span class="bg-emerald-100 text-emerald-600 text-[10px] font-black px-3 py-1 rounded-full uppercase">Today</span>
                                    @elseif($user->created_at->isYesterday())
                                        <span class="text-slate-400 text-[10px] font-bold uppercase">Yesterday</span>
                                    @else
                                        <span class="text-slate-400 text-[10px] font-bold uppercase">{{ $user->created_at->format('d-m-Y') }}</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="px-8 py-5 text-center text-slate-400">No users registered yet</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</body>

</html>
