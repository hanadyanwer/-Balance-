@extends('layouts.app')

@section('title', 'Balance+ | Cultivate a Healthier Life')

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
                    <a href="{{ route('login') }}"
                        class="px-8 py-4 bg-primary text-white rounded-2xl font-bold shadow-lg shadow-primary/20 hover:bg-primaryDark hover:-translate-y-1 transition-all">Get
                        Started Free</a>
                    <a href="#feature"
                        class="px-8 py-4 bg-white text-slate-700 border border-slate-200 rounded-2xl font-bold hover:shadow-md transition-all">Learn
                        More</a>
                </div>
            </div>

            <div class="reveal relative h-[400px] md:h-[500px] rounded-4xl overflow-hidden shadow-2xl group">
                <div class="absolute inset-0 bg-gradient-to-br from-primary/10 to-accent/10 z-[1] pointer-events-none">
                </div>

                <div class="h-full relative overflow-hidden" id="sliderTrack">
                    <div class="slide active"><img src="../images/hero-1.jpg" class="w-full h-full object-cover"
                            alt="Wellness journey"></div>
                    <div class="slide"><img src="../images/healthy.jfif" class="w-full h-full object-cover"
                            alt="Healthy lifestyle"></div>
                    <div class="slide"><img src="../images/hero-2.jpg" class="w-full h-full object-cover"
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
                    <a href="services.html"
                        class="text-primary font-bold text-sm flex items-center gap-2 hover:gap-3 transition-all">Learn
                        more <span>→</span></a>
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
                    <a href="services.html" class="text-accent font-bold text-sm flex items-center gap-2">Learn more
                        →</a>
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
                    <a href="services.html" class="text-sky-600 font-bold text-sm flex items-center gap-2">Learn more
                        →</a>
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
                    <a href="services.html" class="text-primary font-bold text-sm flex items-center gap-2">Learn more
                        →</a>
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
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div
                    class="reveal group p-8 bg-white rounded-[2.5rem] border border-slate-100 hover:shadow-2xl hover:-translate-y-2 transition-all duration-500">
                    <p class="text-slate-600 italic leading-relaxed mb-8 relative">
                        <span class="text-5xl text-primary/10 absolute -top-6 -left-2 font-serif font-black">"</span>
                        Balance+ helped me develop consistent healthy habits without overwhelming me. The daily plans
                        keep me accountable and motivated every single day.
                    </p>
                    <div class="flex items-center gap-4">
                        <img src="../images/user1.jpg" alt="Sarah M."
                            class="w-12 h-12 rounded-full border-2 border-primary object-cover shadow-md">
                        <div>
                            <strong class="block text-slate-900">Sarah M.</strong>
                            <span class="text-xs text-slate-500">Health Enthusiast</span>
                        </div>
                    </div>
                </div>

                <div
                    class="reveal group p-8 bg-white rounded-[2.5rem] border border-slate-100 hover:shadow-2xl hover:-translate-y-2 transition-all duration-500">
                    <p class="text-slate-600 italic leading-relaxed mb-8 relative">
                        <span class="text-5xl text-primary/10 absolute -top-6 -left-2 font-serif font-black">"</span>
                        The personalized workout programs and recipe suggestions made it so easy to stay on track. I've
                        never felt better in my life.
                    </p>
                    <div class="flex items-center gap-4">
                        <img src="../images/user2.jpg" alt="Maria K."
                            class="w-12 h-12 rounded-full border-2 border-primary object-cover shadow-md">
                        <div>
                            <strong class="block text-slate-900">Maria K.</strong>
                            <span class="text-xs text-slate-500">Fitness Professional</span>
                        </div>
                    </div>
                </div>

                <div
                    class="reveal group p-8 bg-white rounded-[2.5rem] border border-slate-100 hover:shadow-2xl hover:-translate-y-2 transition-all duration-500">
                    <p class="text-slate-600 italic leading-relaxed mb-8 relative">
                        <span class="text-5xl text-primary/10 absolute -top-6 -left-2 font-serif font-black">"</span>
                        As a busy parent, Balance+ gives me the structure I need without adding stress. The app
                        integrates seamlessly into my daily routine.
                    </p>
                    <div class="flex items-center gap-4">
                        <img src="../images/user3.jpg" alt="James L."
                            class="w-12 h-12 rounded-full border-2 border-primary object-cover shadow-md">
                        <div>
                            <strong class="block text-slate-900">James L.</strong>
                            <span class="text-xs text-slate-500">Working Parent</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 bg-white text-center">
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
                <a href="#signup"
                    class="px-10 py-4 bg-primary text-white rounded-2xl font-black hover:bg-primaryDark shadow-lg shadow-primary/30 transition-all inline-block">Create
                    Free Account</a>
            </div>
        </div>
    </section>

    <section id="feature" class="py-24 bg-bg overflow-hidden">
        <div class="container mx-auto px-6">
            <div
                class="reveal bg-white rounded-[4rem] p-10 md:p-20 grid md:grid-cols-2 gap-12 items-center border border-slate-100 shadow-sm">
                <div>
                    <h2
                        class="text-3xl md:text-5xl font-black text-slate-900 leading-tight mb-6 italic underline decoration-accent/40">
                        Empowering you to live your best life</h2>
                    <p class="text-slate-6003 text-lg leading-relaxed mb-8">
                        Balance+ was created with the belief that everyone deserves access to personalized wellness
                        tools. We combine science-backed methods with intuitive design to help you achieve lasting
                        health transformations.
                    </p>
                    <a href="#story" class="text-primary font-black text-lg hover:underline transition-all"></a>
                </div>
                <div class="relative group">
                    <img src="../images/banner.jpg" alt="Balance+ story"
                        class="rounded-3xl shadow-2xl group-hover:rotate-1 transition-transform duration-500">
                    <div
                        class="absolute inset-0 border-2 border-primary/20 rounded-3xl translate-x-4 translate-y-4 -z-10 group-hover:translate-x-6 group-hover:translate-y-6 transition-all">
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection