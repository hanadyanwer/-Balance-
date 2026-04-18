<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Balance+ | Success Stories</title>
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
                <a href="{{ route('admin.recipes.index') }}" class="flex items-center gap-3 px-4 py-3 text-sidebarText hover:bg-slate-50 rounded-xl text-sm font-semibold transition-all">
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
            <a href="{{ route('admin.stories.index') }}" class="nav-active flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition-all">
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
            <div class="max-w-7xl mx-auto">
                <!-- Header -->
                <div class="flex justify-between items-center mb-8">
                    <div>
                        <h1 class="text-3xl font-black text-slate-900">Success Stories</h1>
                        <p class="text-slate-500 mt-1">Manage user-submitted stories</p>
                    </div>
                </div>

                @if(session('success'))
                    <div class="bg-green-50 border border-green-200 text-green-700 px-6 py-4 rounded-2xl mb-6">
                        <i class="fas fa-check-circle"></i> {{ session('success') }}
                    </div>
                @endif

                <!-- Stories Grid -->
                <div class="grid md:grid-cols-2 gap-6">
                    @forelse($stories as $story)
                    <div class="bg-white rounded-3xl border border-slate-200 overflow-hidden hover:shadow-lg transition-all">
                        <!-- Story Content -->
                        <div class="p-6">
                            <!-- Status Badge -->
                            <div class="flex justify-between items-start mb-4">
                                @if($story->is_approved)
                                    <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-full">
                                        <i class="fas fa-check-circle"></i> Approved
                                    </span>
                                @else
                                    <span class="px-3 py-1 bg-yellow-100 text-yellow-700 text-xs font-bold rounded-full">
                                        <i class="fas fa-clock"></i> Pending Review
                                    </span>
                                @endif
                                <span class="text-xs text-slate-400">{{ $story->created_at->diffForHumans() }}</span>
                            </div>

                            <!-- Story Text -->
                            <div class="mb-4">
                                <p class="text-slate-600 italic leading-relaxed relative">
                                    <span class="text-4xl text-primary/10 absolute -top-4 -left-2 font-serif font-black">"</span>
                                    {{ $story->story }}
                                </p>
                            </div>

                            <!-- Author Info -->
                            <div class="flex items-center gap-4 mb-6 pt-4 border-t border-slate-100">
                                @if($story->image)
                                <img src="{{ asset($story->image) }}" alt="{{ $story->name }}"
                                    class="w-12 h-12 rounded-full border-2 border-primary object-cover shadow-md">
                                @else
                                <div class="w-12 h-12 rounded-full border-2 border-primary bg-primary/10 flex items-center justify-center shadow-md">
                                    <span class="text-primary font-bold text-lg">{{ substr($story->name, 0, 1) }}</span>
                                </div>
                                @endif
                                <div class="flex-1">
                                    <strong class="block text-slate-900">{{ $story->name }}</strong>
                                    @if($story->title)
                                    <span class="text-xs text-slate-500">{{ $story->title }}</span>
                                    @endif
                                    @if($story->user)
                                    <div class="text-xs text-slate-400 mt-1">
                                        <i class="fas fa-user"></i> {{ $story->user->email }}
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="flex gap-2">
                                @if(!$story->is_approved)
                                <form action="{{ route('admin.stories.approve', $story->id) }}" method="POST" class="flex-1">
                                    @csrf
                                    <button type="submit" class="w-full px-4 py-3 bg-green-500 text-white font-bold rounded-xl hover:bg-green-600 transition-all">
                                        <i class="fas fa-check"></i> Approve
                                    </button>
                                </form>
                                <form action="{{ route('admin.stories.reject', $story->id) }}" method="POST" class="flex-1">
                                    @csrf
                                    <button type="submit" onclick="return confirm('Are you sure you want to reject this story?')"
                                        class="w-full px-4 py-3 bg-yellow-500 text-white font-bold rounded-xl hover:bg-yellow-600 transition-all">
                                        <i class="fas fa-times"></i> Reject
                                    </button>
                                </form>
                                @endif
                                <form action="{{ route('admin.stories.destroy', $story->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure you want to delete this story?')"
                                        class="px-4 py-3 bg-red-500 text-white font-bold rounded-xl hover:bg-red-600 transition-all">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-2 text-center py-12 bg-white rounded-3xl border border-slate-200">
                        <i class="fas fa-inbox text-6xl text-slate-300 mb-4"></i>
                        <h3 class="text-xl font-bold text-slate-600 mb-2">No Stories Yet</h3>
                        <p class="text-slate-400">User stories will appear here when submitted</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </main>
    </div>

    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ session('success') }}',
            confirmButtonColor: '#0B6B7A'
        });
    </script>
    @endif
</body>
</html>
