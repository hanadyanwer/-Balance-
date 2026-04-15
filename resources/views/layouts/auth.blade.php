<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Balance+')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#0B6B7A',
                        primaryDark: '#07505A',
                        accent: '#6FCF97',
                        sky: '#7DD3FC',
                        bg: '#F6FBFC',
                    },
                    borderRadius: { '4xl': '2rem' },
                    boxShadow: { 'custom': '0 2px 12px rgba(11, 107, 122, 0.08)' }
                }
            }
        }
    </script>
    <style>
        .hamburger span {
            display: block;
            width: 24px;
            height: 2px;
            background: #0B6B7A;
            transition: 0.3s;
        }

        .hamburger.active span:nth-child(1) {
            transform: translateY(8px) rotate(45deg);
        }

        .hamburger.active span:nth-child(2) {
            opacity: 0;
        }

        .hamburger.active span:nth-child(3) {
            transform: translateY(-8px) rotate(-45deg);
        }

        .fade-in {
            animation: fadeIn 0.4s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        select {
            appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%230B6B7A' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 1em;
        }
    </style>
    @yield('styles')
</head>

<body class="font-sans text-slate-900 bg-bg overflow-x-hidden flex flex-col min-h-screen">
    <nav class="sticky top-0 z-[1000] bg-white/80 backdrop-blur-md shadow-custom border-b border-slate-100">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <div class="text-2xl font-bold text-primary tracking-tight italic decoration-accent">Balance+</div>

            <button id="hamburger" class="md:hidden flex flex-col gap-1.5 focus:outline-none hamburger">
                <span></span><span></span><span></span>
            </button>

            <ul id="navLinks" class="hidden md:flex items-center gap-8 font-medium text-slate-700">
                <li><a href="{{ route('index') }}#home"
                        class="hover:text-primary transition-all relative group">Home<span
                            class="absolute bottom-[-4px] left-0 w-0 h-0.5 bg-primary transition-all group-hover:w-full"></span></a>
                </li>
                <li><a href="{{ route('index') }}#about"
                        class="hover:text-primary transition-all relative group">About<span
                            class="absolute bottom-[-4px] left-0 w-0 h-0.5 bg-primary transition-all group-hover:w-full"></span></a>
                </li>
                <li><a href="{{ route('index') }}#services"
                        class="hover:text-primary transition-all relative group">Services<span
                            class="absolute bottom-[-4px] left-0 w-0 h-0.5 bg-primary transition-all group-hover:w-full"></span></a>
                </li>
                <li class="flex items-center gap-4 ml-4">
                    @auth
                        <a href="{{ route('home') }}"
                            class="px-5 py-2 bg-primary text-white rounded-lg hover:bg-primaryDark shadow-md transition-all text-sm font-bold">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}"
                            class="px-5 py-2 text-primary border-2 border-primary rounded-lg hover:bg-primary hover:text-white transition-all text-sm font-bold">Log
                            in</a>
                        <a href="{{ route('signup') }}"
                            class="px-5 py-2 bg-primary text-white rounded-lg hover:bg-primaryDark shadow-md transition-all text-sm font-bold border-2 border-primary">Sign
                            up</a>
                    @endauth
                </li>
            </ul>
        </div>

        <div id="mobileMenu"
            class="hidden absolute top-[72px] left-0 right-0 bg-white border-b border-slate-100 px-6 py-8 space-y-4 shadow-xl md:hidden">
            <a href="{{ route('index') }}#home" class="block text-lg font-semibold text-slate-700">Home</a>
            <a href="{{ route('index') }}#about" class="block text-lg font-semibold text-slate-700">About</a>
            <a href="{{ route('index') }}#services" class="block text-lg font-semibold text-slate-700">Services</a>
            <div class="flex flex-col gap-3 pt-4 border-t">
                @auth
                    <a href="{{ route('home') }}"
                        class="w-full py-3 text-center bg-primary text-white rounded-xl font-bold">Dashboard</a>
                @else
                    <a href="{{ route('login') }}"
                        class="w-full py-3 text-center border-2 border-primary text-primary rounded-xl font-bold">Log
                        in</a>
                    <a href="{{ route('signup') }}"
                        class="w-full py-3 text-center bg-primary text-white rounded-xl font-bold">Sign up</a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="flex-grow flex items-center justify-center py-16 px-6">
        @yield('content')
    </main>

    @include('layouts.footer')

    <script>
        const hamburger = document.getElementById('hamburger');
        const mobileMenu = document.getElementById('mobileMenu');

        if (hamburger && mobileMenu) {
            hamburger.addEventListener('click', () => {
                hamburger.classList.toggle('active');
                mobileMenu.classList.toggle('hidden');
            });
        }

        const togglePass = document.getElementById('togglePass');
        const passInput = document.querySelector('input[type="password"]');
        const eyeIcon = document.getElementById('eyeIcon');

        if (togglePass && passInput && eyeIcon) {
            togglePass.addEventListener('click', () => {
                const isPassword = passInput.type === 'password';
                passInput.type = isPassword ? 'text' : 'password';
                eyeIcon.classList.toggle('fa-eye');
                eyeIcon.classList.toggle('fa-eye-slash');
            });
        }
    </script>

    @yield('scripts')
</body>

</html>
