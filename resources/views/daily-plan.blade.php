@extends('layouts.app')

@section('title', 'Daily Wellness Plan | Balance+')

@section('content')
<section class="py-16">
        <div class="container mx-auto px-4 max-w-6xl">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">

                <div class="lg:col-span-8 space-y-8">
                    <div class="flex justify-between items-end mb-4">
                        <div>
                            <h2 class="text-3xl font-black text-slate-800 tracking-tight">Daily Wellness Plan</h2>
                            <p class="text-slate-400 text-xs font-medium">Your personalized nutrition journey for today
                            </p>
                        </div>
                        <button id="viewMenuBtn"
                            class="text-primary text-xs font-bold hover:underline italic transition text-blue-600">View
                            Full Menu</button>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6" id="mealsGrid">
                        <div
                            class="meal-card bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden group hover:shadow-md transition-all">
                            <div class="h-40 overflow-hidden relative">
                                <img src="../images/altumcode-BT-Cx1n1LXA-unsplash.jpg"
                                    class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                                <div class="absolute top-3 right-3 bg-white/80 backdrop-blur-sm p-2 rounded-full"><i
                                        class="fa-solid fa-utensils text-[10px] text-slate-400"></i></div>
                            </div>
                            <div class="p-6">
                                <h3 class="font-black text-slate-800 mb-1 text-sm">Breakfast</h3>
                                <p class="text-[11px] text-slate-500 leading-relaxed mb-6">Start your day with a
                                    nutritious breakfast packed with protein.</p>
                                <button onclick="showRecipe('breakfast')"
                                    class="w-full py-3 bg-slate-50 rounded-2xl text-slate-400 text-[10px] font-black uppercase tracking-widest hover:bg-blue-600 hover:text-white transition-all">View
                                    Recipe</button>
                            </div>
                        </div>

                        <div
                            class="meal-card bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden group hover:shadow-md transition-all">
                            <div class="h-40 overflow-hidden relative">
                                <img src="../images/sumit-bhatia-g7WrssBb1Ak-unsplash.jpg"
                                    class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                                <div class="absolute top-3 right-3 bg-white/80 backdrop-blur-sm p-2 rounded-full"><i
                                        class="fa-regular fa-clock text-[10px] text-slate-400"></i></div>
                            </div>
                            <div class="p-6">
                                <h3 class="font-black text-slate-800 mb-1 text-sm">Lunch</h3>
                                <p class="text-[11px] text-slate-500 leading-relaxed mb-6">Enjoy a balanced lunch with
                                    lean proteins and fresh veggies.</p>
                                <button onclick="showRecipe('lunch')"
                                    class="w-full py-3 bg-slate-50 rounded-2xl text-slate-400 text-[10px] font-black uppercase tracking-widest hover:bg-blue-600 hover:text-white transition-all">View
                                    Recipe</button>
                            </div>
                        </div>

                        <div
                            class="extra-meal hidden meal-card bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden group hover:shadow-md transition-all">
                            <div class="h-40 overflow-hidden relative">
                                <img src="../images/karolina-kolodziejczak-Qf-gqJSWFYQ-unsplash.jpg"
                                    class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                                <div class="absolute top-3 right-3 bg-white/80 backdrop-blur-sm p-2 rounded-full"><i
                                        class="fa-solid fa-moon text-[10px] text-slate-400"></i></div>
                            </div>
                            <div class="p-6">
                                <h3 class="font-black text-slate-800 mb-1 text-sm">Dinner</h3>
                                <p class="text-[11px] text-slate-500 leading-relaxed mb-6">A light and satisfying dinner
                                    to end your day perfectly.</p>
                                <button onclick="showRecipe('dinner')"
                                    class="w-full py-3 bg-slate-50 rounded-2xl text-slate-400 text-[10px] font-black uppercase tracking-widest hover:bg-blue-600 hover:text-white transition-all">View
                                    Recipe</button>
                            </div>
                        </div>

                        <div
                            class="extra-meal hidden meal-card bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden group hover:shadow-md transition-all">
                            <div class="h-40 overflow-hidden relative">
                                <img src="../images/maksim-shutov-pUa1On18Jno-unsplash.jpg"
                                    class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                                <div class="absolute top-3 right-3 bg-white/80 backdrop-blur-sm p-2 rounded-full"><i
                                        class="fa-solid fa-apple-whole text-[10px] text-slate-400"></i></div>
                            </div>
                            <div class="p-6">
                                <h3 class="font-black text-slate-800 mb-1 text-sm">Snack</h3>
                                <p class="text-[11px] text-slate-500 leading-relaxed mb-6">Smart snacking to keep your
                                    energy levels consistent.</p>
                                <button onclick="showRecipe('snack')"
                                    class="w-full py-3 bg-slate-50 rounded-2xl text-slate-400 text-[10px] font-black uppercase tracking-widest hover:bg-blue-600 hover:text-white transition-all">View
                                    Recipe</button>
                            </div>
                        </div>
                    </div>


                    <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="font-black text-slate-800">Daily Workout</h3>
                            <i class="fa-solid fa-bolt-lightning text-yellow-400/40"></i>
                        </div>
                        <div class="flex flex-col md:flex-row gap-8 items-center">
                            <div class="w-full md:w-56 h-36 rounded-3xl overflow-hidden shadow-inner bg-slate-100">
                                <img src="https://images.unsplash.com/photo-1517836357463-d25dfeac3438?w=500"
                                    class="w-full h-full object-cover">
                            </div>
                            <div class="flex-1 text-center md:text-left">
                                <p class="text-xs text-slate-500 leading-relaxed mb-6 font-medium italic">"Your daily
                                    exercise routine designed to build strength and flexibility."</p>
                                <button id="startWorkoutBtn"
                                    class="w-full md:w-auto px-10 py-4 bg-[#10B981] text-white rounded-2xl font-black text-[10px] uppercase tracking-widest hover:shadow-lg hover:shadow-emerald-200 transition-all active:scale-95">Start
                                    Workout</button>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="lg:col-span-4 space-y-8">
                    <div class="bg-white p-8 rounded-[2.5rem] border border-slate-50 shadow-sm text-center">
                        <div class="flex justify-between items-center mb-8">
                            <h3 class="font-black text-slate-800 text-sm uppercase tracking-wider">Hydration</h3>
                            <i class="fa-solid fa-droplet text-cyan-400 text-xs"></i>
                        </div>

                        <div class="mb-8">
                            <div class="flex items-baseline justify-center gap-1">
                                <span id="waterCount"
                                    class="text-6xl font-black text-slate-900 tracking-tighter">0</span>
                                <span class="text-slate-300 text-lg font-bold">/8</span>
                            </div>
                            <p class="text-[10px] font-black text-cyan-500 uppercase tracking-[0.2em] mt-2">Cups Today
                            </p>
                        </div>

                        <div class="grid grid-cols-4 gap-6" id="newCupsContainer"></div>

                        <p class="text-[10px] text-slate-300 mt-8 italic font-medium">Tap each cup as you drink</p>
                    </div>

                    <div class="bg-amber-50/50 p-8 rounded-[2.5rem] border border-amber-100/50">
                        <div
                            class="w-10 h-10 bg-amber-100 rounded-2xl flex items-center justify-center text-amber-600 mb-4 shadow-sm">
                            <i class="fa-solid fa-lightbulb text-sm"></i>
                        </div>
                        <h4 class="font-black text-slate-800 text-xs mb-2 uppercase tracking-wide">Health Tip</h4>
                        <p class="text-[11px] text-slate-500 leading-relaxed font-medium">Stay hydrated! Drinking water
                            regularly helps maintain energy levels and digestion.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
