@extends('layouts.app')

@section('title', 'Profile | Balance+')

@section('content')
<main class="flex-1 max-w-[900px] mx-auto w-full px-6 py-8 md:py-12 flex flex-col gap-6 bg-[#F6FBFC] min-h-screen">

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-4" role="alert">
            <strong class="font-bold">Success! </strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative mb-4" role="alert">
            <strong class="font-bold">Oops! </strong>
            <span class="block sm:inline">
                @foreach($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </span>
        </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" id="profileForm">
        @csrf

        <!-- Hidden field to check if form is being submitted -->
        <input type="hidden" name="form_submitted" value="1">

        <div class="bg-white rounded-2xl border border-[rgba(15,23,42,0.1)] shadow-lg overflow-hidden">
            <div class="w-full h-[180px] bg-[#e8edf2] relative flex items-center justify-center overflow-hidden group">
                @if($user->cover_photo)
                    <img src="{{ asset('storage/' . $user->cover_photo) }}" alt="Cover photo" class="w-full h-full object-cover">
                @else
                    <img src="{{ asset('images/cover.jpg') }}" alt="Cover photo" class="w-full h-full object-cover" onerror="this.style.display='none';">
                @endif
                <label for="coverInput"
                    class="absolute bottom-3.5 right-3.5 inline-flex items-center gap-1.5 px-3.5 py-2 bg-primary text-white rounded-lg text-xs font-semibold cursor-pointer transition-all hover:bg-primaryDark hover:-translate-y-0.5 shadow-md">
                    Edit your cover photo
                </label>
                <input type="file" name="cover_photo" id="coverInput" accept="image/*" class="hidden" onchange="previewCover(this)">
            </div>

            <div class="bg-gradient-to-br from-[#3a3a4a] to-[#2a2a38] px-6 py-3 pb-4 flex items-center gap-4 relative">
                <div class="relative -mt-9 shrink-0">
                    <div class="w-20 h-20 rounded-full bg-[#c8d0d8] border-4 border-[#3a3a4a] flex items-center justify-center overflow-hidden">
                        @if($user->avatar)
                            <img id="userAvatarImg" src="{{ asset('storage/' . $user->avatar) }}" alt="User" class="w-full h-full object-cover">
                        @else
                            <img id="userAvatarImg" src="{{ asset('images/user1.jpg') }}" alt="User" class="w-full h-full object-cover" onerror="this.style.display='none';">
                        @endif
                    </div>
                    <label for="avatarInput" title="Change photo"
                        class="absolute bottom-0.5 right-0.5 w-6 h-6 bg-primary rounded-full flex items-center justify-center cursor-pointer hover:bg-primaryDark border-2 border-[#3a3a4a] transition-colors">
                        <svg class="w-3 h-3 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <path d="M12 20h9" />
                            <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5z" />
                        </svg>
                    </label>
                    <input type="file" name="avatar" id="avatarInput" accept="image/*" class="hidden" onchange="previewAvatar(this)">
                </div>
                <div class="flex-1">
                    <h2 class="text-[1.15rem] font-bold text-white tracking-tight" id="userName">{{ $user->name }}</h2>
                </div>
                <button type="button"
                    class="px-[22px] py-2 bg-[#0F172A] text-white rounded-lg text-sm font-semibold hover:bg-[#1e293b] hover:-translate-y-0.5 transition-all active:bg-primary"
                    onclick="toggleEdit()" id="editBtn">Edit</button>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-[rgba(15,23,42,0.1)] shadow-lg p-8 md:px-9 flex flex-col gap-0">

            <div class="flex flex-col md:flex-row md:items-center gap-4 md:gap-6">
                <label class="text-[15px] font-bold text-[#0F172A] min-w-[160px]">Full Name :</label>
                <div class="flex-1 relative">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-customMuted" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    <input type="text" name="name" value="{{ $user->name }}"
                        class="w-full pl-[38px] pr-3.5 py-[11px] bg-white border border-customBorder rounded-[10px] text-sm focus:border-primary outline-none disabled:bg-[#F6FBFC] disabled:cursor-not-allowed disabled:text-customMuted transition-all"
                        id="nameInput" placeholder="Your Full Name" disabled>
                </div>
            </div>

            <div class="h-px bg-customBorder my-5"></div>

            <div class="flex flex-col md:flex-row md:items-center gap-4 md:gap-6">
                <label class="text-[15px] font-bold text-[#0F172A] min-w-[160px]">Email Address :</label>
                <div class="flex-1 relative">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-customMuted" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="2" y="4" width="20" height="16" rx="2" />
                        <path d="M2 7l10 7 10-7" />
                    </svg>
                    <input type="email" name="email" value="{{ $user->email }}"
                        class="w-full pl-[38px] pr-3.5 py-[11px] bg-white border border-customBorder rounded-[10px] text-sm focus:border-primary outline-none disabled:bg-[#F6FBFC] disabled:cursor-not-allowed disabled:text-customMuted transition-all"
                        id="emailInput" placeholder="username@gmail.com" disabled>
                </div>
            </div>

            <div class="h-px bg-customBorder my-5"></div>

            <div class="flex flex-col md:flex-row md:items-center gap-4 md:gap-6">
                <label class="text-[15px] font-bold text-[#0F172A] min-w-[160px]">Date of Birthday :</label>
                <div class="flex flex-wrap gap-3 items-end">
                    @php
                        $dob = $user->date_of_birth ? \Carbon\Carbon::parse($user->date_of_birth) : null;
                    @endphp
                    <div class="flex flex-col gap-1">
                        <span class="text-[11px] font-semibold text-customMuted uppercase tracking-wider">Month</span>
                        <input type="number" name="dob_month" min="1" max="12"
                            class="w-[72px] p-2.5 bg-white border border-customBorder rounded-[10px] text-sm text-center focus:border-primary outline-none disabled:bg-[#F6FBFC] disabled:cursor-not-allowed"
                            id="dobMonth" value="{{ $dob ? $dob->month : '' }}" placeholder="4" disabled>
                    </div>
                    <div class="flex flex-col gap-1">
                        <span class="text-[11px] font-semibold text-customMuted uppercase tracking-wider">Date</span>
                        <input type="number" name="dob_day" min="1" max="31"
                            class="w-[72px] p-2.5 bg-white border border-customBorder rounded-[10px] text-sm text-center focus:border-primary outline-none disabled:bg-[#F6FBFC] disabled:cursor-not-allowed"
                            id="dobDay" value="{{ $dob ? $dob->day : '' }}" placeholder="11" disabled>
                    </div>
                    <div class="flex flex-col gap-1">
                        <span class="text-[11px] font-semibold text-customMuted uppercase tracking-wider">Year</span>
                        <input type="number" name="dob_year" min="1900" max="2024"
                            class="w-[90px] p-2.5 bg-white border border-customBorder rounded-[10px] text-sm text-center focus:border-primary outline-none disabled:bg-[#F6FBFC] disabled:cursor-not-allowed"
                            id="dobYear" value="{{ $dob ? $dob->year : '' }}" placeholder="2004" disabled>
                    </div>
                </div>
            </div>

            <div class="h-px bg-customBorder my-5"></div>

            <div class="flex flex-col md:flex-row md:items-center gap-4 md:gap-6">
                <label class="text-[15px] font-bold text-[#0F172A] min-w-[160px]">Your Gender :</label>
                <div class="flex gap-7 items-center">
                    <label class="flex items-center gap-2 text-sm font-medium cursor-pointer group has-[:disabled]:cursor-not-allowed">
                        <input type="radio" name="gender" value="female" class="hidden peer" {{ $user->gender == 'female' ? 'checked' : '' }} disabled>
                        <span class="w-[18px] h-[18px] rounded-full border-2 border-customBorder flex items-center justify-center shrink-0 peer-checked:bg-primary peer-checked:border-primary peer-checked:shadow-[inset_0_0_0_3px_white] group-hover:border-primary transition-all peer-disabled:opacity-50"></span>
                        Female
                    </label>
                    <label class="flex items-center gap-2 text-sm font-medium cursor-pointer group has-[:disabled]:cursor-not-allowed">
                        <input type="radio" name="gender" value="male" class="hidden peer" {{ $user->gender == 'male' ? 'checked' : '' }} disabled>
                        <span class="w-[18px] h-[18px] rounded-full border-2 border-customBorder flex items-center justify-center shrink-0 peer-checked:bg-primary peer-checked:border-primary peer-checked:shadow-[inset_0_0_0_3px_white] group-hover:border-primary transition-all peer-disabled:opacity-50"></span>
                        Male
                    </label>
                </div>
            </div>

            <div class="h-px bg-customBorder my-5"></div>

            <div class="text-[15px] font-bold text-[#0F172A] mb-4">Body Information :</div>
            <div class="flex flex-col md:flex-row gap-4 md:gap-8">
                <div class="flex items-center gap-3">
                    <label class="text-sm text-[#0F172A] whitespace-nowrap">Weight (kg) :</label>
                    <input type="number" name="weight" step="0.1"
                        class="w-[100px] p-2.5 bg-white border border-customBorder rounded-[10px] text-sm text-center focus:border-primary outline-none disabled:bg-[#F6FBFC]"
                        id="weightInput" value="{{ $user->weight }}" placeholder="70" disabled>
                </div>
                <div class="flex items-center gap-3">
                    <label class="text-sm text-[#0F172A] whitespace-nowrap">Height (cm) :</label>
                    <input type="number" name="height" step="0.1"
                        class="w-[100px] p-2.5 bg-white border border-customBorder rounded-[10px] text-sm text-center focus:border-primary outline-none disabled:bg-[#F6FBFC]"
                        id="heightInput" value="{{ $user->height }}" placeholder="175" disabled>
                </div>
            </div>

            <div class="h-px bg-customBorder my-5"></div>

            <div class="flex flex-col gap-2.5">
                <label class="text-[15px] font-bold text-[#0F172A]">Health Goal :</label>
                <div class="flex flex-col gap-3 mt-1">
                    <label class="flex items-center gap-2 text-sm font-medium cursor-pointer group has-[:disabled]:cursor-not-allowed">
                        <input type="radio" name="health_goal" value="lose" class="hidden peer" {{ $user->health_goal == 'lose' ? 'checked' : '' }} disabled>
                        <span class="w-[18px] h-[18px] rounded-full border-2 border-customBorder flex items-center justify-center shrink-0 peer-checked:bg-primary peer-checked:border-primary peer-checked:shadow-[inset_0_0_0_3px_white] group-hover:border-primary transition-all peer-disabled:opacity-50"></span>
                        Lose Weight
                    </label>
                    <label class="flex items-center gap-2 text-sm font-medium cursor-pointer group has-[:disabled]:cursor-not-allowed">
                        <input type="radio" name="health_goal" value="gain" class="hidden peer" {{ $user->health_goal == 'gain' ? 'checked' : '' }} disabled>
                        <span class="w-[18px] h-[18px] rounded-full border-2 border-customBorder flex items-center justify-center shrink-0 peer-checked:bg-primary peer-checked:border-primary peer-checked:shadow-[inset_0_0_0_3px_white] group-hover:border-primary transition-all peer-disabled:opacity-50"></span>
                        Gain Weight
                    </label>
                    <label class="flex items-center gap-2 text-sm font-medium cursor-pointer group has-[:disabled]:cursor-not-allowed">
                        <input type="radio" name="health_goal" value="maintain" class="hidden peer" {{ $user->health_goal == 'maintain' ? 'checked' : '' }} disabled>
                        <span class="w-[18px] h-[18px] rounded-full border-2 border-customBorder flex items-center justify-center shrink-0 peer-checked:bg-primary peer-checked:border-primary peer-checked:shadow-[inset_0_0_0_3px_white] group-hover:border-primary transition-all peer-disabled:opacity-50"></span>
                        Maintain Weight
                    </label>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row items-center justify-between mt-7 pt-5 border-t border-customBorder gap-3">
                <button type="submit"
                    class="w-full sm:w-auto px-9 py-3 bg-gradient-to-br from-primary to-primaryDark text-white rounded-[10px] text-[15px] font-bold shadow-md hover:-translate-y-0.5 hover:shadow-lg transition-all disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none"
                    id="saveBtn" disabled>
                    Save
                </button>
                <form method="POST" action="{{ route('logout') }}" class="w-full sm:w-auto">
                    @csrf
                    <button type="submit"
                        class="w-full px-9 py-3 bg-[#C0392B] text-white rounded-[10px] text-[15px] font-bold shadow-md hover:bg-[#a93226] hover:-translate-y-0.5 hover:shadow-lg transition-all">
                        Log Out
                    </button>
                </form>
            </div>
        </div>
    </form>
</main>

@section('scripts')
<script>
    // Show success message if redirected after save
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('success') === '1') {
        const successDiv = document.createElement('div');
        successDiv.className = 'bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-4';
        successDiv.role = 'alert';
        successDiv.innerHTML = '<strong class="font-bold">Success! </strong><span class="block sm:inline">Profile updated successfully!</span>';

        const main = document.querySelector('main');
        main.insertBefore(successDiv, main.firstChild);

        // Remove success parameter from URL
        window.history.replaceState({}, document.title, '{{ route("profile") }}');

        // Remove message after 5 seconds
        setTimeout(() => successDiv.remove(), 5000);
    }

    function toggleEdit() {
        const inputs = document.querySelectorAll('input:not([type="file"])');
        const saveBtn = document.getElementById('saveBtn');
        const editBtn = document.getElementById('editBtn');

        inputs.forEach(input => {
            input.disabled = !input.disabled;
        });

        saveBtn.disabled = !saveBtn.disabled;
        editBtn.textContent = editBtn.textContent === 'Edit' ? 'Cancel' : 'Edit';
    }

    function previewAvatar(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('userAvatarImg').src = e.target.result;
                document.getElementById('userAvatarImg').style.display = 'block';
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function previewCover(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const coverContainer = input.closest('div');
                const img = coverContainer.querySelector('img');
                if (img) {
                    img.src = e.target.result;
                    img.style.display = 'block';
                } else {
                    const newImg = document.createElement('img');
                    newImg.src = e.target.result;
                    newImg.alt = 'Cover photo';
                    newImg.className = 'w-full h-full object-cover';
                    coverContainer.insertBefore(newImg, coverContainer.firstChild);
                }
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Handle form submission errors
    const form = document.getElementById('profileForm');

    // Refresh CSRF token before submit - fetch from server
    form.addEventListener('submit', async function(e) {
        e.preventDefault(); // منع الإرسال المباشر

        const saveBtn = document.getElementById('saveBtn');
        const originalText = saveBtn.textContent;
        saveBtn.disabled = true;
        saveBtn.textContent = 'Saving...';

        try {
            // جلب CSRF token جديد من السيرفر
            const tokenResponse = await fetch('/refresh-csrf');
            const tokenData = await tokenResponse.json();

            // تجهيز البيانات للإرسال
            const formData = new FormData(form);
            formData.set('_token', tokenData.token);

            // إرسال البيانات
            const response = await fetch('{{ route("profile.update") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                }
            });

            const result = await response.json();

            if (response.ok && result.success) {
                // نجح الحفظ - إعادة تحميل الصفحة لعرض البيانات المحدثة
                window.location.href = '{{ route("profile") }}?success=1';
            } else if (response.status === 422 && result.errors) {
                // Validation errors
                let errorMessages = '';
                for (let field in result.errors) {
                    errorMessages += result.errors[field].join('\n') + '\n';
                }
                alert('Validation Errors:\n' + errorMessages);
                saveBtn.disabled = false;
                saveBtn.textContent = originalText;
            } else {
                alert('Error: ' + (result.message || 'Failed to save profile'));
                saveBtn.disabled = false;
                saveBtn.textContent = originalText;
            }
        } catch (error) {
            console.error('Error saving profile:', error);
            alert('An error occurred while saving. Please try again.');
            saveBtn.disabled = false;
            saveBtn.textContent = originalText;
        }
    });

    // Show warning message before token expires
    const warningTime = ({{ config('session.lifetime') }} - 60) * 60 * 1000; // 60 minutes before expiry
    if (warningTime > 0) {
        setTimeout(function() {
            const warning = document.createElement('div');
            warning.className = 'fixed top-4 right-4 bg-yellow-100 border-2 border-yellow-400 text-yellow-800 px-6 py-4 rounded-lg shadow-2xl z-50 max-w-md';
            warning.innerHTML = '<strong class="font-bold">⚠️ Warning!</strong><br><span class="text-sm">Your session will expire soon. Please save your changes now or refresh the page.</span>';
            document.body.appendChild(warning);

            setTimeout(() => warning.remove(), 60000); // Remove after 1 minute
        }, warningTime);
    }


</script>
@endsection
@endsection
