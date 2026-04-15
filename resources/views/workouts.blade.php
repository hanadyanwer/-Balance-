@extends('layouts.app')

@section('title', 'Training Plans | Balance+')

@section('styles')
<style>
    .active-fav i {
        color: #ef4444 !important;
    }

    .active-fav {
        background-color: #fef2f2 !important;
        border-color: #fee2e2 !important;
    }
</style>
@endsection

@section('content')
<section class="max-w-7xl mx-auto px-6 py-12 flex-grow">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-8 mb-16">
            <div>
                <h2 class="text-5xl font-black text-slate-900 tracking-tight mb-4">Training Plans</h2>
                <p class="text-slate-500 font-medium">Professional workouts designed for your fitness goals.</p>
            </div>

            <div class="flex flex-wrap items-center gap-2 bg-white p-2 rounded-3xl border border-slate-200 shadow-sm">
                <button
                    class="filter active px-6 py-2.5 rounded-2xl text-sm font-bold transition-all bg-primary text-white"
                    data-filter="all">All</button>
                <button
                    class="filter px-6 py-2.5 rounded-2xl text-sm font-bold text-slate-500 transition-all hover:bg-slate-50"
                    data-filter="beginner">Beginner</button>
                <button
                    class="filter px-6 py-2.5 rounded-2xl text-sm font-bold text-slate-500 transition-all hover:bg-slate-50"
                    data-filter="intermediate">Intermediate</button>
                <button
                    class="filter px-6 py-2.5 rounded-2xl text-sm font-bold text-slate-500 transition-all hover:bg-slate-50"
                    data-filter="advanced">Advanced</button>
                <button
                    class="filter w-12 h-12 flex items-center justify-center rounded-2xl text-red-400 border border-transparent hover:border-red-100 hover:bg-red-50 transition-all"
                    data-filter="favorites">
                    <i class="fa-solid fa-heart text-lg"></i>
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8" id="workoutsGrid">

            <div class="card group bg-white p-5 rounded-4xl border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-300"
                data-category="intermediate"
                data-desc="High-intensity interval training designed to spike your heart rate and boost morning metabolism."
                data-video="https://www.youtube.com/watch?v=ml6cT4AZdqI">
                <div
                    class="relative h-48 overflow-hidden rounded-3xl mb-5 bg-orange-50 flex items-center justify-center">
                    <span class="text-6xl group-hover:scale-110 transition duration-700">ًںڈƒ</span>
                    <span
                        class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-[10px] font-black text-primary uppercase shadow-sm">Intermediate</span>
                </div>
                <h3 class="text-xl font-bold mb-2">Morning HIIT</h3>
                <p class="text-sm text-slate-500 mb-6 line-clamp-2 italic">Intense bursts of activity followed by short
                    rest periods.</p>
                <div class="flex gap-4 text-xs font-bold text-slate-400 mb-6">
                    <span class="flex items-center gap-1.5"><i class="fa-regular fa-clock text-primary"></i> 30m</span>
                    <span class="flex items-center gap-1.5"><i class="fa-solid fa-fire text-primary"></i> 320
                        kcal</span>
                </div>
                <div class="flex items-center gap-3">
                    <button
                        class="view-plan-btn flex-1 bg-primary text-white py-3.5 rounded-2xl font-bold hover:bg-primaryDark transition shadow-lg shadow-primary/20">View
                        Plan</button>
                    <button
                        class="heart-btn w-12 h-12 flex items-center justify-center border border-slate-100 rounded-2xl text-slate-300 hover:text-red-500 hover:bg-red-50 transition-all"><i
                            class="fa-solid fa-heart text-xl"></i></button>
                </div>
            </div>

            <div class="card group bg-white p-5 rounded-4xl border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-300"
                data-category="beginner"
                data-desc="A gentle flow of yoga poses aimed at improving flexibility, balance, and mental clarity."
                data-video="https://www.youtube.com/watch?v=v7AYKMP6rOE">
                <div class="relative h-48 overflow-hidden rounded-3xl mb-5 bg-blue-50 flex items-center justify-center">
                    <span class="text-6xl group-hover:scale-110 transition duration-700">ًں§ک</span>
                    <span
                        class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-[10px] font-black text-primary uppercase shadow-sm">Beginner</span>
                </div>
                <h3 class="text-xl font-bold mb-2">Yoga Flow</h3>
                <p class="text-sm text-slate-500 mb-6 line-clamp-2 italic">Connect your breath with movement in this
                    basic flow.</p>
                <div class="flex gap-4 text-xs font-bold text-slate-400 mb-6">
                    <span class="flex items-center gap-1.5"><i class="fa-regular fa-clock text-primary"></i> 45m</span>
                    <span class="flex items-center gap-1.5"><i class="fa-solid fa-fire text-primary"></i> 180
                        kcal</span>
                </div>
                <div class="flex items-center gap-3">
                    <button
                        class="view-plan-btn flex-1 bg-primary text-white py-3.5 rounded-2xl font-bold hover:bg-primaryDark transition shadow-lg shadow-primary/20">View
                        Plan</button>
                    <button
                        class="heart-btn w-12 h-12 flex items-center justify-center border border-slate-100 rounded-2xl text-slate-300 hover:text-red-500 hover:bg-red-50 transition-all"><i
                            class="fa-solid fa-heart text-xl"></i></button>
                </div>
            </div>

            <div class="card group bg-white p-5 rounded-4xl border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-300"
                data-category="advanced"
                data-desc="Advanced resistance training focusing on compound movements to build serious muscle mass."
                data-video="https://www.youtube.com/watch?v=q6_9v9I3oYI">
                <div
                    class="relative h-48 overflow-hidden rounded-3xl mb-5 bg-slate-100 flex items-center justify-center">
                    <span class="text-6xl group-hover:scale-110 transition duration-700">ًںڈ‹ï¸ڈ</span>
                    <span
                        class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-[10px] font-black text-primary uppercase shadow-sm">Advanced</span>
                </div>
                <h3 class="text-xl font-bold mb-2">Strength Power</h3>
                <p class="text-sm text-slate-500 mb-6 line-clamp-2 italic">Master the art of lifting with focused
                    strength routines.</p>
                <div class="flex gap-4 text-xs font-bold text-slate-400 mb-6">
                    <span class="flex items-center gap-1.5"><i class="fa-regular fa-clock text-primary"></i> 60m</span>
                    <span class="flex items-center gap-1.5"><i class="fa-solid fa-fire text-primary"></i> 480
                        kcal</span>
                </div>
                <div class="flex items-center gap-3">
                    <button
                        class="view-plan-btn flex-1 bg-primary text-white py-3.5 rounded-2xl font-bold hover:bg-primaryDark transition shadow-lg shadow-primary/20">View
                        Plan</button>
                    <button
                        class="heart-btn w-12 h-12 flex items-center justify-center border border-slate-100 rounded-2xl text-slate-300 hover:text-red-500 hover:bg-red-50 transition-all"><i
                            class="fa-solid fa-heart text-xl"></i></button>
                </div>
            </div>

            <div class="card group bg-white p-5 rounded-4xl border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-300"
                data-category="intermediate"
                data-desc="Focus on your stability and abdominal strength with this dedicated core workout."
                data-video="https://www.youtube.com/watch?v=dJlFmxiL11s">
                <div
                    class="relative h-48 overflow-hidden rounded-3xl mb-5 bg-green-50 flex items-center justify-center">
                    <span class="text-6xl group-hover:scale-110 transition duration-700">ًں¤¸</span>
                    <span
                        class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-[10px] font-black text-primary uppercase shadow-sm">Intermediate</span>
                </div>
                <h3 class="text-xl font-bold mb-2">Core & Abs</h3>
                <p class="text-sm text-slate-500 mb-6 line-clamp-2 italic">Target your midsection for better posture and
                    power.</p>
                <div class="flex gap-4 text-xs font-bold text-slate-400 mb-6">
                    <span class="flex items-center gap-1.5"><i class="fa-regular fa-clock text-primary"></i> 25m</span>
                    <span class="flex items-center gap-1.5"><i class="fa-solid fa-fire text-primary"></i> 240
                        kcal</span>
                </div>
                <div class="flex items-center gap-3">
                    <button
                        class="view-plan-btn flex-1 bg-primary text-white py-3.5 rounded-2xl font-bold hover:bg-primaryDark transition shadow-lg shadow-primary/20">View
                        Plan</button>
                    <button
                        class="heart-btn w-12 h-12 flex items-center justify-center border border-slate-100 rounded-2xl text-slate-300 hover:text-red-500 hover:bg-red-50 transition-all"><i
                            class="fa-solid fa-heart text-xl"></i></button>
                </div>
            </div>

            <div class="card group bg-white p-5 rounded-4xl border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-300"
                data-category="beginner"
                data-desc="A low-impact walking routine to help you de-stress and recover after a long day."
                data-video="https://www.youtube.com/watch?v=gC_L9qAHVJ8">
                <div
                    class="relative h-48 overflow-hidden rounded-3xl mb-5 bg-emerald-50 flex items-center justify-center">
                    <span class="text-6xl group-hover:scale-110 transition duration-700">ًںڑ¶</span>
                    <span
                        class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-[10px] font-black text-primary uppercase shadow-sm">Beginner</span>
                </div>
                <h3 class="text-xl font-bold mb-2">Evening Walk</h3>
                <p class="text-sm text-slate-500 mb-6 line-clamp-2 italic">Maintain your step count with this relaxing
                    active recovery.</p>
                <div class="flex gap-4 text-xs font-bold text-slate-400 mb-6">
                    <span class="flex items-center gap-1.5"><i class="fa-regular fa-clock text-primary"></i> 40m</span>
                    <span class="flex items-center gap-1.5"><i class="fa-solid fa-fire text-primary"></i> 200
                        kcal</span>
                </div>
                <div class="flex items-center gap-3">
                    <button
                        class="view-plan-btn flex-1 bg-primary text-white py-3.5 rounded-2xl font-bold hover:bg-primaryDark transition shadow-lg shadow-primary/20">View
                        Plan</button>
                    <button
                        class="heart-btn w-12 h-12 flex items-center justify-center border border-slate-100 rounded-2xl text-slate-300 hover:text-red-500 hover:bg-red-50 transition-all"><i
                            class="fa-solid fa-heart text-xl"></i></button>
                </div>
            </div>

            <div class="card group bg-white p-5 rounded-4xl border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-300"
                data-category="advanced"
                data-desc="The ultimate fat burner using the 20-10 Tabata method for maximum efficiency."
                data-video="https://www.youtube.com/watch?v=E_mbi_p_e6g">
                <div class="relative h-48 overflow-hidden rounded-3xl mb-5 bg-red-50 flex items-center justify-center">
                    <span class="text-6xl group-hover:scale-110 transition duration-700">ًں”¥</span>
                    <span
                        class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-[10px] font-black text-primary uppercase shadow-sm">Advanced</span>
                </div>
                <h3 class="text-xl font-bold mb-2">Tabata Burn</h3>
                <p class="text-sm text-slate-500 mb-6 line-clamp-2 italic">Short duration, maximum intensity bursts.</p>
                <div class="flex gap-4 text-xs font-bold text-slate-400 mb-6">
                    <span class="flex items-center gap-1.5"><i class="fa-regular fa-clock text-primary"></i> 20m</span>
                    <span class="flex items-center gap-1.5"><i class="fa-solid fa-fire text-primary"></i> 400
                        kcal</span>
                </div>
                <div class="flex items-center gap-3">
                    <button
                        class="view-plan-btn flex-1 bg-primary text-white py-3.5 rounded-2xl font-bold hover:bg-primaryDark transition shadow-lg shadow-primary/20">View
                        Plan</button>
                    <button
                        class="heart-btn w-12 h-12 flex items-center justify-center border border-slate-100 rounded-2xl text-slate-300 hover:text-red-500 hover:bg-red-50 transition-all"><i
                            class="fa-solid fa-heart text-xl"></i></button>
                </div>
            </div>

            <div class="card group bg-white p-5 rounded-4xl border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-300"
                data-category="intermediate"
                data-desc="Tone and sculpt your muscles using controlled, precise Pilates movements."
                data-video="https://www.youtube.com/watch?v=y3_m9P2_Iog">
                <div class="relative h-48 overflow-hidden rounded-3xl mb-5 bg-pink-50 flex items-center justify-center">
                    <span class="text-6xl group-hover:scale-110 transition duration-700">ًں§کâ€چâ™€ï¸ڈ</span>
                    <span
                        class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-[10px] font-black text-primary uppercase shadow-sm">Intermediate</span>
                </div>
                <h3 class="text-xl font-bold mb-2">Pilates Sculpt</h3>
                <p class="text-sm text-slate-500 mb-6 line-clamp-2 italic">Build long, lean muscles with this bodyweight
                    flow.</p>
                <div class="flex gap-4 text-xs font-bold text-slate-400 mb-6">
                    <span class="flex items-center gap-1.5"><i class="fa-regular fa-clock text-primary"></i> 35m</span>
                    <span class="flex items-center gap-1.5"><i class="fa-solid fa-fire text-primary"></i> 220
                        kcal</span>
                </div>
                <div class="flex items-center gap-3">
                    <button
                        class="view-plan-btn flex-1 bg-primary text-white py-3.5 rounded-2xl font-bold hover:bg-primaryDark transition shadow-lg shadow-primary/20">View
                        Plan</button>
                    <button
                        class="heart-btn w-12 h-12 flex items-center justify-center border border-slate-100 rounded-2xl text-slate-300 hover:text-red-500 hover:bg-red-50 transition-all"><i
                            class="fa-solid fa-heart text-xl"></i></button>
                </div>
            </div>

            <div class="card group bg-white p-5 rounded-4xl border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-300"
                data-category="advanced"
                data-desc="A high-energy cardio boxing session to improve coordination and burn calories fast."
                data-video="https://www.youtube.com/watch?v=K6Yv6X9N-T0">
                <div
                    class="relative h-48 overflow-hidden rounded-3xl mb-5 bg-gray-100 flex items-center justify-center">
                    <span class="text-6xl group-hover:scale-110 transition duration-700">ًں¥ٹ</span>
                    <span
                        class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-[10px] font-black text-primary uppercase shadow-sm">Advanced</span>
                </div>
                <h3 class="text-xl font-bold mb-2">Boxing Burn</h3>
                <p class="text-sm text-slate-500 mb-6 line-clamp-2 italic">Unleash your power with explosive punches and
                    drills.</p>
                <div class="flex gap-4 text-xs font-bold text-slate-400 mb-6">
                    <span class="flex items-center gap-1.5"><i class="fa-regular fa-clock text-primary"></i> 30m</span>
                    <span class="flex items-center gap-1.5"><i class="fa-solid fa-fire text-primary"></i> 450
                        kcal</span>
                </div>
                <div class="flex items-center gap-3">
                    <button
                        class="view-plan-btn flex-1 bg-primary text-white py-3.5 rounded-2xl font-bold hover:bg-primaryDark transition shadow-lg shadow-primary/20">View
                        Plan</button>
                    <button
                        class="heart-btn w-12 h-12 flex items-center justify-center border border-slate-100 rounded-2xl text-slate-300 hover:text-red-500 hover:bg-red-50 transition-all"><i
                            class="fa-solid fa-heart text-xl"></i></button>
                </div>
            </div>

            <div class="card group bg-white p-5 rounded-4xl border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-300"
                data-category="beginner"
                data-desc="Deep static stretching to help release muscle tension and improve range of motion."
                data-video="https://www.youtube.com/watch?v=2eA2Koq6pTI">
                <div class="relative h-48 overflow-hidden rounded-3xl mb-5 bg-cyan-50 flex items-center justify-center">
                    <span class="text-6xl group-hover:scale-110 transition duration-700">âکپï¸ڈ</span>
                    <span
                        class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-[10px] font-black text-primary uppercase shadow-sm">Beginner</span>
                </div>
                <h3 class="text-xl font-bold mb-2">Deep Recovery</h3>
                <p class="text-sm text-slate-500 mb-6 line-clamp-2 italic">The perfect end to a heavy training week.</p>
                <div class="flex gap-4 text-xs font-bold text-slate-400 mb-6">
                    <span class="flex items-center gap-1.5"><i class="fa-regular fa-clock text-primary"></i> 20m</span>
                    <span class="flex items-center gap-1.5"><i class="fa-solid fa-fire text-primary"></i> 80 kcal</span>
                </div>
                <div class="flex items-center gap-3">
                    <button
                        class="view-plan-btn flex-1 bg-primary text-white py-3.5 rounded-2xl font-bold hover:bg-primaryDark transition shadow-lg shadow-primary/20">View
                        Plan</button>
                    <button
                        class="heart-btn w-12 h-12 flex items-center justify-center border border-slate-100 rounded-2xl text-slate-300 hover:text-red-500 hover:bg-red-50 transition-all"><i
                            class="fa-solid fa-heart text-xl"></i></button>
                </div>
            </div>

            <div class="card group bg-white p-5 rounded-4xl border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-300"
                data-category="advanced"
                data-desc="Build explosive power in your legs with high-volume squats and lunges."
                data-video="https://www.youtube.com/watch?v=Eml2xnoLpYE">
                <div
                    class="relative h-48 overflow-hidden rounded-3xl mb-5 bg-indigo-50 flex items-center justify-center">
                    <span class="text-6xl group-hover:scale-110 transition duration-700">ًں¦µ</span>
                    <span
                        class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-[10px] font-black text-primary uppercase shadow-sm">Advanced</span>
                </div>
                <h3 class="text-xl font-bold mb-2">Leg Power</h3>
                <p class="text-sm text-slate-500 mb-6 line-clamp-2 italic">A challenging routine for a stronger lower
                    body.</p>
                <div class="flex gap-4 text-xs font-bold text-slate-400 mb-6">
                    <span class="flex items-center gap-1.5"><i class="fa-regular fa-clock text-primary"></i> 50m</span>
                    <span class="flex items-center gap-1.5"><i class="fa-solid fa-fire text-primary"></i> 520
                        kcal</span>
                </div>
                <div class="flex items-center gap-3">
                    <button
                        class="view-plan-btn flex-1 bg-primary text-white py-3.5 rounded-2xl font-bold hover:bg-primaryDark transition shadow-lg shadow-primary/20">View
                        Plan</button>
                    <button
                        class="heart-btn w-12 h-12 flex items-center justify-center border border-slate-100 rounded-2xl text-slate-300 hover:text-red-500 hover:bg-red-50 transition-all"><i
                            class="fa-solid fa-heart text-xl"></i></button>
                </div>
            </div>

        </div>
    </section>
@endsection
