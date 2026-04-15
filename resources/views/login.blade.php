@extends('layouts.auth')

@section('title', 'Login | Balance+')

@section('content')
<div class="w-full max-w-[480px] fade-in">
            <div class="bg-white p-10 rounded-4xl shadow-xl shadow-slate-200/50 border border-slate-50 relative">

                <div id="loginAlert"
                    class="hidden mb-6 p-4 rounded-xl bg-red-50 text-red-600 text-xs font-bold border border-red-100 flex items-center gap-3 italic">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    <span id="errorText">Invalid email or password</span>
                </div>

                <div class="text-center mb-10">
                    <h1 class="text-3xl font-black text-primary mb-2 tracking-tight">Welcome Back</h1>
                    <p class="text-slate-400 italic">Enter your details to continue your journey</p>
                </div>

                <form method="POST" action="{{ route('login.submit') }}" class="space-y-6">
                    @csrf
                    <div>
                        <label
                            class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 ml-1">Email
                            Address</label>
                        <div class="relative">
                            <span class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-300">
                                <i class="fa-solid fa-envelope"></i>
                            </span>
                            <input type="email" name="email" value="{{ old('email') }}"
                                class="w-full pl-12 pr-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:border-primary focus:outline-none transition-all placeholder:text-slate-300 @error('email') border-red-500 @enderror"
                                placeholder="your@email.com" required>
                        </div>
                        @error('email')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-2 ml-1">
                            <label
                                class="text-[10px] font-black uppercase tracking-widest text-slate-400">Password</label>
                            <a href="#" class="text-[10px] font-bold text-primary hover:underline">Forgot?</a>
                        </div>
                        <div class="relative">
                            <span class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-300">
                                <i class="fa-solid fa-lock"></i>
                            </span>
                            <input type="password" name="password"
                                class="w-full pl-12 pr-12 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:border-primary focus:outline-none transition-all placeholder:text-slate-300 @error('password') border-red-500 @enderror"
                                placeholder="••••••••" required>
                            <button type="button" id="togglePass"
                                class="absolute right-5 top-1/2 -translate-y-1/2 text-slate-300 hover:text-slate-500">
                                <i class="fa-solid fa-eye" id="eyeIcon"></i>
                            </button>
                        </div>
                        @error('password')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" name="remember" class="w-4 h-4 accent-primary rounded">
                        <span class="text-xs font-bold text-slate-500 italic">Remember me on this device</span>
                    </label>

                    <button type="submit"
                        class="w-full py-4 bg-primary text-white rounded-2xl font-black text-sm uppercase tracking-widest hover:bg-primaryDark transition-all shadow-lg shadow-teal-100 active:scale-[0.98]">
                        Log In
                    </button>
                </form>

                <p class="text-center mt-10 text-sm font-medium text-slate-500">
                    New to Balance+?
                    <a href="{{ route('signup') }}" class="text-primary font-black hover:underline ml-1">Create
                        Account</a>
                </p>
            </div>
        </div>
    </div>
@endsection
