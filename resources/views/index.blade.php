@extends('layouts.app')

@section('title', 'Balance+ | Cultivate a Healthier Life')

@section('styles')
<style>
    .slide {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        transition: opacity 1s ease-in-out;
        z-index: 0;
    }

    .slide.active {
        opacity: 1;
        z-index: 10;
    }

    .dot.active {
        width: 2rem;
        background-color: white;
    }
</style>
@endsection

@section('content')
<section class="relative py-12 md:py-24 overflow-hidden" id="home">
        <div
            class="absolute top-0 left-0 w-[800px] h-[600px] bg-accent/5 rounded-full blur-[100px] -translate-x-1/2 -translate-y-1/2 pointer-events-none">
        </div>

        <div class="container mx-auto px-6 grid md:grid-cols-2 gap-12 items-center relative z-10">
            <div class="reveal">
                <h1 class="text-4xl md:text-6xl font-black text-slate-900 leading-tight mb-6">
                    Cultivate a <span class="text-primary italic underline decoration-accent/40">Healthier Life</span>
                    Starting Today
                </h1>
                <p class="text-lg text-slate-600 mb-10 leading-relaxed max-w-lg">
                    Balance+ helps you build sustainable wellness habits through personalized daily plans, nutrition
                    guidance, and mindful lifestyle tracking. Transform your health journey one day at a time.
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('signup') }}"
                        class="px-8 py-4 bg-primary text-white rounded-2xl font-bold shadow-lg shadow-primary/20 hover:bg-primaryDark hover:-translate-y-1 transition-all">Get
                        Started Free</a>
                    <a href="#feature"
                        class="px-8 py-4 bg-white text-slate-700 border border-slate-200 rounded-2xl font-bold hover:shadow-md transition-all">Learn
                        More</a>
                </div>
                <div class="mt-6">
                    <a href="{{ route('admin.login') }}"
                        class="inline-flex items-center gap-2 text-sm font-semibold text-slate-500 hover:text-primary transition-colors">
                        <i class="fas fa-lock"></i>
                        <span>Admin Login</span>
                    </a>
                </div>
            </div>

            <div class="reveal relative h-[400px] md:h-[500px] rounded-4xl overflow-hidden shadow-2xl group">
                <div class="absolute inset-0 bg-gradient-to-br from-primary/10 to-accent/10 z-[1] pointer-events-none">
                </div>

                <div class="h-full relative overflow-hidden" id="sliderTrack">
                    <div class="slide active"><img src="{{ asset('images/hero-1.jpg') }}"
                            class="w-full h-full object-cover" alt="Wellness journey"></div>
                    <div class="slide"><img src="{{ asset('images/hero-3.jpg') }}" class="w-full h-full object-cover"
                            alt="Healthy lifestyle"></div>
                    <div class="slide"><img src="{{ asset('images/hero-2.jpg') }}" class="w-full h-full object-cover"
                            alt="Fitness and nutrition"></div>
                </div>

                <button
                    class="absolute top-1/2 left-4 -translate-y-1/2 bg-white/90 p-3 rounded-full shadow-lg z-20 text-primary hover:scale-110 transition-transform hidden group-hover:block"
                    onclick="moveSlide(-1)">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <polyline points="15 18 9 12 15 6"></polyline>
                    </svg>
                </button>
                <button
                    class="absolute top-1/2 right-4 -translate-y-1/2 bg-white/90 p-3 rounded-full shadow-lg z-20 text-primary hover:scale-110 transition-transform hidden group-hover:block"
                    onclick="moveSlide(1)">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <polyline points="9 18 15 12 9 6"></polyline>
                    </svg>
                </button>

                <div class="absolute bottom-6 left-1/2 -translate-x-1/2 flex gap-2 z-20" id="sliderDots">
                    <button class="w-8 h-2 bg-white rounded-full transition-all dot active" data-index="0"></button>
                    <button class="w-2 h-2 bg-white/50 rounded-full transition-all dot" data-index="1"></button>
                    <button class="w-2 h-2 bg-white/50 rounded-full transition-all dot" data-index="2"></button>
                </div>
            </div>
        </div>
    </section>

    @auth
    <section class="py-16 bg-gradient-to-br from-primary/5 to-accent/5">
        <div class="container mx-auto px-6">
            <div class="reveal text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-black text-slate-900 mb-3">
                    <i class="fas fa-chart-line text-primary"></i> Your Health Profile
                </h2>
                <p class="text-slate-600">Track your progress toward your goals and stay motivated.</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 max-w-6xl mx-auto">
                <div class="reveal bg-white rounded-2xl p-6 shadow-lg border border-slate-100 hover:shadow-xl transition-all">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-4xl">📏</span>
                        <span class="text-xs font-bold px-3 py-1 rounded-full {{ auth()->user()->bmi ? (auth()->user()->bmi < 18.5 ? 'bg-blue-100 text-blue-700' : (auth()->user()->bmi < 25 ? 'bg-green-100 text-green-700' : (auth()->user()->bmi < 30 ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700'))) : 'bg-gray-100 text-gray-700' }}">
                            {{ auth()->user()->getBMICategory() ?? 'Not Calculated' }}
                        </span>
                    </div>
                    <h3 class="text-slate-500 text-sm font-semibold mb-2">BMI</h3>
                    <p class="text-3xl font-black text-slate-900">{{ auth()->user()->bmi ?? auth()->user()->calculateBMI() ?? '--' }}</p>
                    <p class="text-xs text-slate-400 mt-2">Body Mass Index</p>
                </div>

                <div class="reveal bg-white rounded-2xl p-6 shadow-lg border border-slate-100 hover:shadow-xl transition-all">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-4xl">⚖️</span>
                        <span class="text-xs font-bold px-3 py-1 rounded-full bg-primary/10 text-primary">Weight</span>
                    </div>
                    <h3 class="text-slate-500 text-sm font-semibold mb-2">Current Weight</h3>
                    <p class="text-3xl font-black text-slate-900">{{ auth()->user()->weight ?? '--' }}</p>
                    <p class="text-xs text-slate-400 mt-2">kilograms</p>
                </div>

                <div class="reveal bg-white rounded-2xl p-6 shadow-lg border border-slate-100 hover:shadow-xl transition-all">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-4xl">📐</span>
                        <span class="text-xs font-bold px-3 py-1 rounded-full bg-accent/10 text-accent">Height</span>
                    </div>
                    <h3 class="text-slate-500 text-sm font-semibold mb-2">Height</h3>
                    <p class="text-3xl font-black text-slate-900">{{ auth()->user()->height ?? '--' }}</p>
                    <p class="text-xs text-slate-400 mt-2">centimeters</p>
                </div>

                <div class="reveal bg-gradient-to-br from-primary to-accent rounded-2xl p-6 shadow-lg text-white hover:shadow-xl transition-all">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-4xl">🎯</span>
                        <span class="text-xs font-bold px-3 py-1 rounded-full bg-white/20">Your Goal</span>
                    </div>
                    <h3 class="text-white/80 text-sm font-semibold mb-2">Goal</h3>
                    <p class="text-2xl font-black">{{ auth()->user()->getGoalInArabic() ?? 'Not Set' }}</p>
                    <a href="{{ route('profile.setup') }}" class="text-xs text-white/80 mt-2 inline-block hover:text-white">Update Profile →</a>
                </div>
            </div>

            @if(auth()->user()->health_goal)
            <div class="reveal max-w-2xl mx-auto mt-8 bg-white rounded-2xl p-6 shadow-lg border border-slate-100">
                <div class="flex items-start gap-4">
                    <div class="text-4xl">💪</div>
                    <div>
                        <h4 class="font-bold text-slate-900 mb-2">Keep Going!</h4>
                        <p class="text-slate-600 text-sm leading-relaxed">
                            @if(auth()->user()->health_goal == 'lose_weight')
                                You are on the right path to lose weight. Stay consistent with your daily plan and nutrition.
                            @elseif(auth()->user()->health_goal == 'gain_weight')
                                You are building healthy mass. Keep your meals balanced and stay active.
                            @elseif(auth()->user()->health_goal == 'build_muscle')
                                Muscle development takes time. Keep training smart and eating enough protein.
                            @else
                                Maintain your healthy habits and stay consistent for long-term balance.
                            @endif
                        </p>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </section>
    @else
    <section class="py-16 bg-gradient-to-br from-primary/10 to-accent/10">
        <div class="container mx-auto px-6 text-center">
            <div class="max-w-2xl mx-auto bg-white rounded-3xl p-10 shadow-lg border border-slate-100">
                <h2 class="text-3xl font-black text-slate-900 mb-4">Get Personalized Health Insights</h2>
                <p class="text-slate-600 mb-6">Log in to see your goal, height, weight, and daily wellness advice right on the homepage.</p>
                <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-8 py-4 bg-primary text-white rounded-2xl font-bold shadow-lg hover:bg-primaryDark transition-all">Log In to View Profile</a>
            </div>
        </div>
    </section>
    @endauth

    <div class="w-full leading-[0] h-[60px] bg-bg">
        <svg class="relative block w-full h-full" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M0,0 C300,80 600,80 900,40 C1050,20 1150,0 1200,0 L1200,120 L0,120 Z" fill="#FFFFFF"></path>
        </svg>
    </div>

    <section class="py-24 bg-white" id="services">
        <div class="container mx-auto px-6">
            <div class="reveal text-center mb-20">
                <span
                    class="text-primary font-bold tracking-widest text-xs uppercase bg-primary/10 px-4 py-1.5 rounded-full">OUR
                    SERVICES</span>
                <h2 class="text-4xl md:text-5xl font-black text-slate-900 mt-6 mb-4 italic">Holistic Health Solutions
                </h2>
                <p class="text-slate-500 max-w-xl mx-auto text-lg leading-relaxed italic">Comprehensive tools and
                    resources designed to support every aspect of your wellness journey</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div
                    class="reveal group p-8 bg-bg rounded-3xl border border-slate-100 hover:shadow-2xl transition-all relative overflow-hidden">
                    <span
                        class="absolute top-4 right-4 bg-primary text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase">Popular</span>
                    <div
                        class="w-14 h-14 bg-primary/10 rounded-2xl flex items-center justify-center text-primary mb-8 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <rect x="3" y="4" width="18" height="18" rx="2" />
                            <path d="M16 2v4M8 2v4M3 10h18" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Daily Plans</h3>
                    <p class="text-slate-500 text-sm mb-6 leading-relaxed">Personalized daily schedules tailored to your
                        goals, lifestyle, and preferences for consistent progress.</p>
                    @guest
                    <a href="javascript:void(0)" onclick="showLoginPrompt()"
                        class="text-primary font-bold text-sm flex items-center gap-2 hover:gap-3 transition-all">Learn
                        more <span>→</span></a>
                    @else
                    <a href="{{ route('daily-plan') }}"
                        class="text-primary font-bold text-sm flex items-center gap-2 hover:gap-3 transition-all">Learn
                        more <span>→</span></a>
                    @endguest
                </div>

                <div
                    class="reveal group p-8 bg-bg rounded-3xl border border-slate-100 hover:shadow-2xl transition-all relative overflow-hidden">
                    <span
                        class="absolute top-4 right-4 bg-accent text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase">New</span>
                    <div
                        class="w-14 h-14 bg-accent/10 rounded-2xl flex items-center justify-center text-accent mb-8 group-hover:scale-110 transition-transform text-accent">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="9" />
                            <path d="M9 12l2 2 4-4" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-slate-900">Healthy Recipes</h3>
                    <p class="text-slate-500 text-sm mb-6">Delicious, nutritious meal ideas with detailed nutrition
                        information and easy-to-follow instructions.</p>
                    @guest
                    <a href="javascript:void(0)" onclick="showLoginPrompt()" class="text-accent font-bold text-sm flex items-center gap-2 hover:gap-3 transition-all">Learn more <span>→</span></a>
                    @else
                    <a href="{{ route('recipes') }}" class="text-accent font-bold text-sm flex items-center gap-2 hover:gap-3 transition-all">Learn more <span>→</span></a>
                    @endguest
                </div>

                <div
                    class="reveal group p-8 bg-bg rounded-3xl border border-slate-100 hover:shadow-2xl transition-all relative overflow-hidden text-sky">
                    <span
                        class="absolute top-4 right-4 bg-sky-500 text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase">Popular</span>
                    <div
                        class="w-14 h-14 bg-sky/10 rounded-2xl flex items-center justify-center mb-8 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="9" />
                            <path d="M12 7v5l3 3" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-slate-900">Workout Programs</h3>
                    <p class="text-slate-500 text-sm mb-6">Customized exercise routines for all fitness levels, from
                        beginner-friendly to advanced training.</p>
                    @guest
                    <a href="javascript:void(0)" onclick="showLoginPrompt()" class="text-sky-600 font-bold text-sm flex items-center gap-2 hover:gap-3 transition-all">Learn more <span>→</span></a>
                    @else
                    <a href="{{ route('workouts') }}" class="text-sky-600 font-bold text-sm flex items-center gap-2 hover:gap-3 transition-all">Learn more <span>→</span></a>
                    @endguest
                </div>

                <div
                    class="reveal group p-8 bg-bg rounded-3xl border border-slate-100 hover:shadow-2xl transition-all relative overflow-hidden">
                    <span
                        class="absolute top-4 right-4 bg-primary text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase">Personalized</span>
                    <div
                        class="w-14 h-14 bg-primary/10 rounded-2xl flex items-center justify-center text-primary mb-8 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M12 2.69l5.66 5.66a8 8 0 1 1-11.31 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Water Tracking</h3>
                    <p class="text-slate-500 text-sm mb-6">Simple hydration monitoring with reminders to help you
                        maintain optimal water intake throughout the day.</p>
                    @guest
                    <a href="javascript:void(0)" onclick="showLoginPrompt()" class="text-primary font-bold text-sm flex items-center gap-2 hover:gap-3 transition-all">Learn more <span>→</span></a>
                    @else
                    <a href="{{ route('water-tracking') }}" class="text-primary font-bold text-sm flex items-center gap-2 hover:gap-3 transition-all">Learn more <span>→</span></a>
                    @endguest
                </div>
            </div>
        </div>
    </section>

    <div class="w-full leading-[0] h-[60px] bg-bg">
        <svg class="relative block w-full h-full rotate-180" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M0,0 C300,80 600,80 900,40 C1050,20 1150,0 1200,0 L1200,120 L0,120 Z" fill="#FFFFFF"></path>
        </svg>
    </div>

    <section class="py-24 bg-bg" id="about">
        <div class="container mx-auto px-6">
            <div class="reveal flex flex-col md:flex-row justify-between items-end mb-16 gap-6">
                <div>
                    <div class="flex items-center gap-4 mb-4">
                        <span
                            class="text-primary font-bold tracking-widest text-xs uppercase bg-primary/10 px-4 py-1.5 rounded-full">OUR
                            STORIES</span>
                        <span class="bg-accent/20 text-accent text-xs font-bold px-4 py-1.5 rounded-full">Success
                            Stories</span>
                    </div>
                    <h2 class="text-4xl md:text-5xl font-black text-slate-900 leading-tight italic">Real Results from
                        Real People</h2>
                </div>
                @auth
                <button onclick="openStoryModal()" class="reveal px-8 py-4 bg-primary text-white font-bold rounded-2xl hover:bg-primary/90 transition-all hover:shadow-lg flex items-center gap-2">
                    <i class="fas fa-plus"></i>
                    Share Your Story
                </button>
                @endauth
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                @forelse($stories as $story)
                <div
                    class="reveal group p-8 bg-white rounded-[2.5rem] border border-slate-100 hover:shadow-2xl hover:-translate-y-2 transition-all duration-500">
                    <p class="text-slate-600 italic leading-relaxed mb-8 relative">
                        <span class="text-5xl text-primary/10 absolute -top-6 -left-2 font-serif font-black">"</span>
                        {{ $story->story }}
                    </p>
                    <div class="flex items-center gap-4">
                        @if($story->image)
                        <img src="{{ asset($story->image) }}" alt="{{ $story->name }}"
                            class="w-12 h-12 rounded-full border-2 border-primary object-cover shadow-md">
                        @else
                        <div class="w-12 h-12 rounded-full border-2 border-primary bg-primary/10 flex items-center justify-center shadow-md">
                            <span class="text-primary font-bold text-lg">{{ substr($story->name, 0, 1) }}</span>
                        </div>
                        @endif
                        <div>
                            <strong class="block text-slate-900">{{ $story->name }}</strong>
                            @if($story->title)
                            <span class="text-xs text-slate-500">{{ $story->title }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-3 text-center py-12">
                    <p class="text-slate-500 text-lg">No stories yet. Be the first to share your success story!</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <section id="feature" class="py-24 bg-white text-center">
        <div class="container mx-auto px-6">
            <h2 class="reveal text-4xl md:text-5xl font-black mb-20 italic">Start Your Transformation</h2>

            <div class="flex flex-wrap justify-center gap-16 md:gap-32 mb-20 relative">
                <div class="reveal group text-center relative z-10">
                    <div
                        class="w-20 h-20 bg-gradient-to-br from-primary to-primaryDark text-white text-3xl font-black flex items-center justify-center rounded-full mx-auto mb-6 shadow-xl group-hover:scale-110 transition-transform">
                        1</div>
                    <p class="font-bold text-slate-900 uppercase tracking-wide">Create an account</p>
                </div>
                <div class="reveal group text-center relative z-10">
                    <div
                        class="w-20 h-20 bg-gradient-to-br from-primary to-primaryDark text-white text-3xl font-black flex items-center justify-center rounded-full mx-auto mb-6 shadow-xl group-hover:scale-110 transition-transform">
                        2</div>
                    <p class="font-bold text-slate-900 uppercase tracking-wide">Choose your goals</p>
                </div>
                <div class="reveal group text-center relative z-10">
                    <div
                        class="w-20 h-20 bg-gradient-to-br from-primary to-primaryDark text-white text-3xl font-black flex items-center justify-center rounded-full mx-auto mb-6 shadow-xl group-hover:scale-110 transition-transform">
                        3</div>
                    <p class="font-bold text-slate-900 uppercase tracking-wide">Get your daily plan</p>
                </div>
            </div>

            <div
                class="reveal max-w-lg mx-auto bg-gradient-to-br from-primary/5 to-accent/5 p-12 rounded-[3rem] border-2 border-primary/10 shadow-sm hover:-translate-y-1 transition-all group">
                <p class="text-xl text-slate-700 font-medium mb-8">Ready to begin your wellness journey?</p>
                <a href="{{ route('signup') }}"
                    class="px-10 py-4 bg-primary text-white rounded-2xl font-black hover:bg-primaryDark shadow-lg shadow-primary/30 transition-all inline-block">Create
                    Free Account</a>
            </div>
        </div>
    </section>

    <section class="py-24 bg-bg overflow-hidden">
        <div class="container mx-auto px-6">
            <div
                class="reveal bg-white rounded-[4rem] p-10 md:p-20 grid md:grid-cols-2 gap-12 items-center border border-slate-100 shadow-sm">
                <div>
                    <h2
                        class="text-3xl md:text-5xl font-black text-slate-900 leading-tight mb-6 italic underline decoration-accent/40">
                        Empowering you to live your best life</h2>
                    <p class="text-slate-600 text-lg leading-relaxed mb-8">
                        Balance+ was created with the belief that everyone deserves access to personalized wellness
                        tools. We combine science-backed methods with intuitive design to help you achieve lasting
                        health transformations.
                    </p>
                    <a href="#story" class="text-primary font-black text-lg hover:underline transition-all"></a>
                </div>
                <div class="relative group">
                    <img src="{{ asset('images/banner.jpg') }}" alt="Balance+ story"
                        class="rounded-3xl shadow-2xl group-hover:rotate-1 transition-transform duration-500">
                    <div
                        class="absolute inset-0 border-2 border-primary/20 rounded-3xl translate-x-4 translate-y-4 -z-10 group-hover:translate-x-6 group-hover:translate-y-6 transition-all">
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
<script>
    function showLoginPrompt() {
        Swal.fire({
            title: 'Login Required',
            html: `
                <div class="text-center">
                    <i class="fas fa-lock text-5xl text-primary mb-4"></i>
                    <p class="text-gray-600 mb-4">You need to login to access this feature</p>
                </div>
            `,
            showCancelButton: true,
            confirmButtonText: '<i class="fas fa-sign-in-alt"></i> Login',
            cancelButtonText: 'Create Account',
            confirmButtonColor: '#0B6B7A',
            cancelButtonColor: '#6FCF97',
            reverseButtons: true,
            customClass: {
                confirmButton: 'px-6 py-3 rounded-xl font-bold',
                cancelButton: 'px-6 py-3 rounded-xl font-bold'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '{{ route('login') }}';
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                window.location.href = '{{ route('signup') }}';
            }
        });
    }

    // Story Modal
    function openStoryModal() {
        Swal.fire({
            title: '<span class="text-2xl font-black text-slate-900">Share Your Success Story</span>',
            html: `
                <form id="storyForm" action="{{ route('stories.store') }}" method="POST" enctype="multipart/form-data" class="text-left">
                    @csrf
                    <div class="space-y-4 mt-6">
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Your Name *</label>
                            <input type="text" name="name" required
                                class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-primary"
                                placeholder="e.g. Sarah M.">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Title/Role (Optional)</label>
                            <input type="text" name="title"
                                class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-primary"
                                placeholder="e.g. Health Enthusiast">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Your Story * (min 50 characters)</label>
                            <textarea name="story" required rows="5"
                                class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-primary"
                                placeholder="Share your journey with Balance+..."></textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Your Photo (Optional)</label>
                            <input type="file" name="image" accept="image/*"
                                class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-primary">
                            <p class="text-xs text-slate-500 mt-1">Max 10MB - JPEG, PNG, JPG, GIF, WEBP</p>
                        </div>
                        <div class="bg-blue-50 border border-blue-200 rounded-xl p-4">
                            <p class="text-xs text-blue-700">
                                <i class="fas fa-info-circle"></i> Your story will be reviewed by our team before being published.
                            </p>
                        </div>
                    </div>
                </form>
            `,
            showCancelButton: true,
            confirmButtonText: '<i class="fas fa-paper-plane"></i> Submit Story',
            cancelButtonText: 'Cancel',
            confirmButtonColor: '#0B6B7A',
            cancelButtonColor: '#94A3B8',
            width: '600px',
            customClass: {
                confirmButton: 'px-6 py-3 rounded-xl font-bold',
                cancelButton: 'px-6 py-3 rounded-xl font-bold'
            },
            preConfirm: () => {
                const form = document.getElementById('storyForm');
                const formData = new FormData(form);
                const story = formData.get('story');

                if (story.length < 50) {
                    Swal.showValidationMessage('Story must be at least 50 characters long');
                    return false;
                }

                return true;
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('storyForm').submit();
            }
        });
    }

    // Show success message if story was submitted
    @if(session('story_success'))
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'success',
            title: '<span class="text-2xl font-black text-slate-900">Story Submitted Successfully!</span>',
            html: `
                <div class="text-left mt-4">
                    <p class="text-slate-600 mb-4">Thank you for sharing your success story! Your story has been submitted and will be reviewed by our team.</p>
                    <div class="bg-blue-50 border border-blue-200 rounded-xl p-4">
                        <p class="text-sm text-blue-700">
                            <i class="fas fa-info-circle"></i> Once approved, your story will inspire others on their wellness journey!
                        </p>
                    </div>
                </div>
            `,
            confirmButtonText: 'Got it!',
            confirmButtonColor: '#0B6B7A',
            customClass: {
                confirmButton: 'px-6 py-3 rounded-xl font-bold'
            }
        });
    });
    @endif
</script>
@endsection
