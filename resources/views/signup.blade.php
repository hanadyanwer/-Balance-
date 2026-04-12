<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up | Balance+</title>
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
        /* أنيميشن الهامبرغر منيو */
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

        /* ستايل الـ Select */
        select {
            appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%230B6B7A' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 1em;
        }
    </style>
</head>

<body class="font-sans text-slate-900 bg-bg overflow-x-hidden flex flex-col min-h-screen">

    <nav class="sticky top-0 z-[1000] bg-white/80 backdrop-blur-md shadow-custom border-b border-slate-100">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <div class="text-2xl font-bold text-primary tracking-tight italic underline decoration-accent">Balance+
            </div>

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
                    <a href="{{ route('login') }}"
                        class="px-5 py-2 text-primary border-2 border-primary rounded-lg hover:bg-primary hover:text-white transition-all text-sm font-bold">Log
                        in</a>
                    <a href="{{ route('signup') }}"
                        class="px-5 py-2 bg-primary text-white rounded-lg hover:bg-primaryDark shadow-md transition-all text-sm font-bold border-2 border-primary">Sign
                        up</a>
                </li>
            </ul>
        </div>

        <div id="mobileMenu"
            class="hidden absolute top-[72px] left-0 right-0 bg-white border-b border-slate-100 px-6 py-8 space-y-4 shadow-xl md:hidden">
            <a href="{{ route('index') }}#home" class="block text-lg font-semibold text-slate-700">Home</a>
            <a href="{{ route('index') }}#about" class="block text-lg font-semibold text-slate-700">About</a>
            <a href="{{ route('index') }}#services" class="block text-lg font-semibold text-slate-700">Services</a>
            <div class="flex flex-col gap-3 pt-4 border-t">
                <a href="{{ route('login') }}"
                    class="w-full py-3 text-center border-2 border-primary text-primary rounded-xl font-bold">Log in</a>
                <a href="{{ route('signup') }}"
                    class="w-full py-3 text-center bg-primary text-white rounded-xl font-bold">Sign up</a>
            </div>
        </div>
    </nav>

    <main class="flex-grow flex items-center justify-center py-12 px-6">
        <div class="w-full max-w-[550px]">
            <div
                class="bg-white p-10 rounded-4xl shadow-xl shadow-slate-200/50 border border-slate-50 relative overflow-hidden">

                <div id="authAlert"
                    class="hidden mb-6 p-4 rounded-xl bg-red-50 text-red-600 text-xs font-bold border border-red-100 flex items-center gap-3 italic">
                </div>

                <div class="text-center mb-8">
                    <h1 class="text-3xl font-black text-primary mb-2 tracking-tight">Create Account</h1>
                    <p class="text-slate-400 italic">"Your journey to balance starts here"</p>
                </div>

                <form method="POST" action="{{ route('signup.submit') }}" id="signupForm" class="space-y-4">
                    @csrf
                    <input type="text" name="fullName" id="fullName" value="{{ old('fullName') }}"
                        class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:border-primary focus:outline-none transition-all placeholder:text-slate-300 @error('fullName') border-red-500 @enderror"
                        placeholder="Full Name">
                    @error('fullName')<p class="text-red-500 text-xs">{{ $message }}</p>@enderror

                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                        class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:border-primary focus:outline-none transition-all placeholder:text-slate-300 @error('email') border-red-500 @enderror"
                        placeholder="Email Address">
                    @error('email')<p class="text-red-500 text-xs">{{ $message }}</p>@enderror

                    <input type="password" name="password" id="password"
                        class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:border-primary focus:outline-none transition-all placeholder:text-slate-300 @error('password') border-red-500 @enderror"
                        placeholder="Password (8+ characters)">
                    @error('password')<p class="text-red-500 text-xs">{{ $message }}</p>@enderror

                    <input type="password" name="password_confirmation" id="password_confirmation"
                        class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:border-primary focus:outline-none transition-all placeholder:text-slate-300"
                        placeholder="Confirm Password">

                    <div class="grid grid-cols-3 gap-3">
                        <select id="dobMonth"
                            class="px-4 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-bold text-slate-600 cursor-pointer">
                            <option value="">Month</option>
                            <option value="1">Jan</option>
                            <option value="2">Feb</option>
                            <option value="3">Mar</option>
                            <option value="4">Apr</option>
                            <option value="5">May</option>
                            <option value="6">Jun</option>
                            <option value="7">Jul</option>
                            <option value="8">Aug</option>
                            <option value="9">Sep</option>
                            <option value="10">Oct</option>
                            <option value="11">Nov</option>
                            <option value="12">Dec</option>
                        </select>
                        <select id="dobDay"
                            class="px-4 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-bold text-slate-600 cursor-pointer">
                            <option value="">Day</option>
                        </select>
                        <select id="dobYear"
                            class="px-4 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-bold text-slate-600 cursor-pointer">
                            <option value="">Year</option>
                        </select>
                    </div>
                    <div class="space-y-2">
                        <label
                            class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3 ml-1">Gender</label>
                        <div class="grid grid-cols-2 gap-4">
                            <label class="cursor-pointer group">
                                <input type="radio" name="gender" value="female" class="peer hidden" checked>
                                <div
                                    class="flex items-center justify-center gap-3 p-4 border-2 border-slate-100 rounded-2xl text-slate-500 font-bold text-sm transition-all peer-checked:border-primary peer-checked:bg-teal-50 peer-checked:text-primary group-hover:border-primary/30">
                                    <i class="fa-solid fa-venus"></i>
                                    Female
                                </div>
                            </label>

                            <label class="cursor-pointer group">
                                <input type="radio" name="gender" value="male" class="peer hidden">
                                <div
                                    class="flex items-center justify-center gap-3 p-4 border-2 border-slate-100 rounded-2xl text-slate-500 font-bold text-sm transition-all peer-checked:border-primary peer-checked:bg-teal-50 peer-checked:text-primary group-hover:border-primary/30">
                                    <i class="fa-solid fa-mars"></i>
                                    Male
                                </div>
                            </label>
                        </div>
                    </div>
                    <label class="flex items-center gap-3 cursor-pointer py-2">
                        <input type="checkbox" name="terms" id="terms" class="w-4 h-4 accent-primary" required>
                        <span class="text-xs font-bold text-slate-500 italic">I accept the terms and privacy
                            policy</span>
                    </label>

                    <button type="submit"
                        class="w-full py-4 bg-primary text-white rounded-2xl font-black text-sm uppercase tracking-widest hover:bg-primaryDark transition-all shadow-lg shadow-teal-100/50 active:scale-95">
                        Sign Up
                    </button>
                </form>
            </div>
        </div>
    </main>
    <footer class="bg-[#0F172A] text-white pt-16 pb-8 mt-auto">
        <div class="max-w-[1100px] mx-auto px-6 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-12 mb-10 text-sm">
            <div>
                <div class="text-accent text-2xl font-bold mb-3">Balance+</div>
                <p class="text-slate-400 leading-relaxed">Science-based nutrition and workouts for a healthier version
                    of you.</p>
            </div>
            <div>
                <h4 class="font-bold mb-5 uppercase tracking-wider text-xs">Quick Links</h4>
                <ul class="text-slate-400 space-y-3">
                    <li><a href="#" class="hover:text-white transition-colors">Home</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">About Us</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Services</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold mb-5 uppercase tracking-wider text-xs">Support</h4>
                <ul class="text-slate-400 space-y-3">
                    <li><a href="#" class="hover:text-white transition-colors">Contact Us</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">FAQ</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Privacy Policy</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold mb-5 uppercase tracking-wider text-xs">Follow Us</h4>
                <div class="flex gap-4">
                    <a href="#"
                        class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center hover:bg-primary transition-all">f</a>
                    <a href="#"
                        class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center hover:bg-primary transition-all">in</a>
                    <a href="#"
                        class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center hover:bg-primary transition-all">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <rect x="2" y="2" width="20" height="20" rx="5" />
                            <circle cx="12" cy="12" r="4" />
                            <circle cx="17.5" cy="6.5" r="1" fill="currentColor" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        <div class="border-t border-white/5 pt-8 text-center text-slate-500 text-xs">
            © 2026 Balance+ · All rights reserved
        </div>
    </footer>
    <script>
        // سكريبت الهيدر الأصلي (الموبايل منيو)
        const hamburger = document.getElementById('hamburger');
        const mobileMenu = document.getElementById('mobileMenu');
        hamburger.addEventListener('click', () => {
            hamburger.classList.toggle('active');
            mobileMenu.classList.toggle('hidden');
        });

        // سكريبت توليد الأيام والسنوات
        const d = document.getElementById('dobDay'), y = document.getElementById('dobYear');
        for (let i = 1; i <= 31; i++) d.innerHTML += `<option value="${i}">${i}</option>`;
        for (let i = 2026; i >= 1970; i--) y.innerHTML += `<option value="${i}">${i}</option>`;

        // فحص الحقول قبل الإرسال
        document.getElementById('signupForm').addEventListener('submit', function (e) {
            const fullName = document.getElementById('fullName').value.trim();
            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value.trim();
            const termsChecked = document.getElementById('terms').checked;

            // التعطيل إذا كانت الحقول فارغة
            if (!fullName || !email || !password || !termsChecked) {
                e.preventDefault();
                const alertBox = document.getElementById('authAlert');
                alertBox.innerHTML = '<i class="fa-solid fa-triangle-exclamation"></i> Please fill in all fields and accept the terms';
                alertBox.classList.remove('hidden');
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
        });
    </script>
</body>

</html>