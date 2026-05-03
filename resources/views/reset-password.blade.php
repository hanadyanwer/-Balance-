@extends('layouts.auth')

@section('title', 'Reset Password | Balance+')

@section('content')
<div class="w-full max-w-[480px] fade-in">
    <div class="bg-white p-10 rounded-4xl shadow-xl shadow-slate-200/50 border border-slate-50 relative">

        @if($errors->any())
            <div class="mb-6 p-4 rounded-xl bg-red-50 text-red-600 text-xs font-bold border border-red-100 flex items-center gap-3 italic">
                <i class="fa-solid fa-triangle-exclamation"></i>
                <span>{{ $errors->first() }}</span>
            </div>
        @endif

        <div class="text-center mb-10">
            <h1 class="text-3xl font-black text-primary mb-2 tracking-tight">Reset Password</h1>
            <p class="text-slate-400 italic">Enter your new password</p>
        </div>

        <form method="POST" action="{{ route('password.update') }}" class="space-y-6">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div>
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 ml-1">New Password</label>
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

            <div>
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 ml-1">Confirm New Password</label>
                <div class="relative">
                    <span class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-300">
                        <i class="fa-solid fa-lock"></i>
                    </span>
                    <input type="password" name="password_confirmation"
                        class="w-full pl-12 pr-12 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:border-primary focus:outline-none transition-all placeholder:text-slate-300 @error('password_confirmation') border-red-500 @enderror"
                        placeholder="••••••••" required>
                    <button type="button" id="togglePassConfirm"
                        class="absolute right-5 top-1/2 -translate-y-1/2 text-slate-300 hover:text-slate-500">
                        <i class="fa-solid fa-eye" id="eyeIconConfirm"></i>
                    </button>
                </div>
                @error('password_confirmation')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                class="w-full py-4 bg-primary text-white rounded-2xl font-black text-sm uppercase tracking-widest hover:bg-primaryDark transition-all shadow-lg shadow-teal-100 active:scale-[0.98]">
                Reset Password
            </button>
        </form>

        <p class="text-center mt-10 text-sm font-medium text-slate-500">
            Remember your password?
            <a href="{{ route('login') }}" class="text-primary font-black hover:underline ml-1">Log In</a>
        </p>
    </div>
</div>

<script>
    // Toggle password visibility for new password
    document.getElementById('togglePass').addEventListener('click', function() {
        const input = document.querySelector('input[name="password"]');
        const icon = document.getElementById('eyeIcon');
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    });

    // Toggle password visibility for confirm password
    document.getElementById('togglePassConfirm').addEventListener('click', function() {
        const input = document.querySelector('input[name="password_confirmation"]');
        const icon = document.getElementById('eyeIconConfirm');
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    });
</script>
@endsection