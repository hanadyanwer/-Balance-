@extends('layouts.auth')

@section('title', 'Sign Up | Balance+')

@section('content')
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
                        placeholder="Password (8+ characters)">>
                    @error('password')<p class="text-red-500 text-xs">{{ $message }}</p>@enderror

                    <input type="password" name="password_confirmation" id="password_confirmation"
                        class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:border-primary focus:outline-none transition-all placeholder:text-slate-300"
                        placeholder="Confirm Password">>

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
    </div>
@endsection

@section('scripts')
<script>
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
@endsection
