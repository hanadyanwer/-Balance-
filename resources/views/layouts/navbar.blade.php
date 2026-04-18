<nav class="bg-white fixed top-0 left-0 right-0 z-50 shadow-sm border-b border-slate-100">
    <div class="max-w-7xl mx-auto px-6 h-16 flex items-center justify-between">
        <div class="text-2xl font-bold text-primary tracking-tight">Balance+</div>

        <button class="md:hidden text-primary text-2xl" id="mobileMenuBtn">
            <i class="fa-solid fa-bars"></i>
        </button>

        <ul class="hidden md:flex items-center gap-8 text-sm font-semibold">
            <li><a href="{{ route('home') }}" class="text-primary border-b-2 border-primary pb-1">Home</a></li>
            <li><a href="#about" class="text-slate-500 hover:text-primary transition">About</a></li>
            <li><a href="{{ route('services') }}" class="text-slate-500 hover:text-primary transition">Services</a></li>

            <li class="relative group">
                <div class="flex items-center gap-2 cursor-pointer py-2" id="userBtn">
                    @auth
                        @if(Auth::user()->avatar)
                            <img src="{{ asset('storage/' . Auth::user()->avatar) }}"
                                class="w-8 h-8 rounded-full border border-slate-200 object-cover" alt="{{ Auth::user()->name }}">
                        @else
                            <img src="{{ asset('images/openclipart-vectors-avatar-1299805_1280.png') }}"
                                class="w-8 h-8 rounded-full border border-slate-200" alt="User">
                        @endif
                    @else
                        <img src="{{ asset('images/openclipart-vectors-avatar-1299805_1280.png') }}"
                            class="w-8 h-8 rounded-full border border-slate-200" alt="User">
                    @endauth
                    <i class="fa-solid fa-chevron-down text-[10px] text-slate-400"></i>
                </div>
                <div
                    class="absolute right-0 top-full w-40 bg-white shadow-xl rounded-xl py-2 border border-slate-100 hidden group-hover:block animate-fade-in">
                    @auth
                        <p class="px-4 py-2 text-xs font-bold text-primary">{{ Auth::user()->name }}</p>
                        <a href="{{ route('profile') }}"
                            class="block px-4 py-2 text-xs hover:bg-slate-50 transition">Profile</a>
                        <form method="POST" action="{{ route('logout') }}" class="inline w-full">
                            @csrf
                            <button type="submit"
                                class="w-full text-left px-4 py-2 text-xs text-red-500 hover:bg-red-50 transition">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}"
                            class="block px-4 py-2 text-xs hover:bg-slate-50 transition">Login</a>
                    @endauth
                </div>
            </li>
        </ul>
    </div>

    <!-- Mobile Menu -->
    <div id="mobileMenu" class="hidden md:hidden bg-white border-t border-slate-100">
        <div class="px-6 py-4 space-y-3">
            <a href="{{ route('home') }}" class="block text-sm font-semibold text-slate-500 hover:text-primary">Home</a>
            <a href="#about" class="block text-sm font-semibold text-slate-500 hover:text-primary">About</a>
            <a href="{{ route('services') }}"
                class="block text-sm font-semibold text-slate-500 hover:text-primary">Services</a>
            @auth
                <a href="{{ route('profile') }}"
                    class="block text-sm font-semibold text-slate-500 hover:text-primary">Profile</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full text-left text-sm font-semibold text-red-500 hover:text-red-700">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}"
                    class="block text-sm font-semibold text-slate-500 hover:text-primary">Login</a>
                <a href="{{ route('signup') }}" class="block text-sm font-semibold text-slate-500 hover:text-primary">Sign
                    Up</a>
            @endauth
        </div>
    </div>
</nav>
