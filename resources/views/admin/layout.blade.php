<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel') | Balance+</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#0B6B7A',
                        primaryDark: '#07505A',
                        bgBody: '#F8FAFC',
                        sidebarText: '#64748B',
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }

        .btn-primary {
            background-color: #0B6B7A;
            color: white;
            padding: 0.5rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            background-color: #07505A;
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .table-hover tbody tr:hover {
            background-color: #F8FAFC;
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-gradient-to-b from-primary to-primaryDark text-white shadow-xl fixed h-full">
            <div class="p-6">
                <h2 class="text-2xl font-bold mb-8">⚡ Balance+ Admin</h2>
                <nav class="space-y-2">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 transition {{ request()->routeIs('admin.dashboard') ? 'bg-white/20' : '' }}">
                        <i class="fas fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ route('admin.recipes.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 transition {{ request()->routeIs('admin.recipes.*') ? 'bg-white/20' : '' }}">
                        <i class="fas fa-utensils"></i>
                        <span>Recipes</span>
                    </a>
                    <a href="{{ route('admin.workouts.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 transition {{ request()->routeIs('admin.workouts.*') ? 'bg-white/20' : '' }}">
                        <i class="fas fa-dumbbell"></i>
                        <span>Workouts</span>
                    </a>
                    <a href="{{ route('admin.daily-plans.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 transition {{ request()->routeIs('admin.daily-plans.*') ? 'bg-white/20' : '' }}">
                        <i class="fas fa-calendar"></i>
                        <span>Daily Plans</span>
                    </a>
                    <a href="{{ route('admin.tips.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 transition {{ request()->routeIs('admin.tips.*') ? 'bg-white/20' : '' }}">
                        <i class="fas fa-lightbulb"></i>
                        <span>Tips</span>
                    </a>
                    <a href="{{ route('admin.hydration.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 transition {{ request()->routeIs('admin.hydration.*') ? 'bg-white/20' : '' }}">
                        <i class="fas fa-droplet"></i>
                        <span>Hydration</span>
                    </a>
                    <div class="pt-6 mt-6 border-t border-white/20">
                        <a href="{{ route('home') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 transition">
                            <i class="fas fa-arrow-left"></i>
                            <span>Back to Site</span>
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-red-500/20 transition text-left">
                                <i class="fas fa-sign-out-alt"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </div>
                </nav>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 ml-64 p-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
                    {{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</body>
</html>
