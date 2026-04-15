@extends('layouts.app')

@section('title', 'Services | Balance+')

@section('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

    body {
        font-family: 'Inter', sans-serif;
    }
</style>
@endsection

@section('content')
<section class="max-w-5xl mx-auto px-6 py-16 text-center">
        <h1 class="text-4xl font-bold text-slate-900 mb-4 tracking-tight">Our Services</h1>
        <p class="text-slate-500 mb-12 max-w-lg mx-auto leading-relaxed">Science-based nutrition and professional
            training plans tailored for your unique fitness journey.</p>

        <div class="space-y-6">

            <div
                class="flex flex-col md:flex-row items-center justify-between bg-cardGray p-6 md:p-8 rounded-[2rem] gap-8 hover:scale-[1.01] transition-transform duration-300">
                <div class="text-left flex-1 order-2 md:order-1">
                    <h3 class="text-2xl font-bold text-slate-800 mb-3">Daily Plan</h3>
                    <p class="text-slate-600 mb-6 leading-relaxed">Personalized daily nutrition goals designed to keep
                        your metabolism and energy at peak levels.</p>
                    <a href="{{ route('daily-plan') }}"
                        class="inline-block bg-[#0a7c86] text-white px-8 py-3 rounded-full text-sm font-bold hover:bg-primaryDark transition shadow-md shadow-cyan-900/10">
                        View Full Plan
                    </a>
                </div>
                <div class="w-full md:w-48 h-48 rounded-2xl overflow-hidden order-1 md:order-2 shadow-inner">
                    <img src="../images/scottwebb-training-828726.jpg" class="w-full h-full object-cover"
                        alt="Daily Plan">
                </div>
            </div>

            <div
                class="flex flex-col md:flex-row items-center justify-between bg-cardGray p-6 md:p-8 rounded-[2rem] gap-8 hover:scale-[1.01] transition-transform duration-300">
                <div class="text-left flex-1 order-2 md:order-1">
                    <h3 class="text-2xl font-bold text-slate-800 mb-3">Healthy Recipes</h3>
                    <p class="text-slate-600 mb-6 leading-relaxed">Discover a library of nutritious and delicious
                        recipes with full caloric and macro breakdowns.</p>
                    <a href="{{ route('recipes') }}"
                        class="inline-block bg-[#1fa463] text-white px-8 py-3 rounded-full text-sm font-bold hover:bg-green-700 transition shadow-md shadow-green-900/10">
                        View Full Recipes
                    </a>
                </div>
                <div class="w-full md:w-48 h-48 rounded-2xl overflow-hidden order-1 md:order-2 shadow-inner">
                    <img src="../images/katie-smith-uQs1802D0CQ-unsplash.jpg" class="w-full h-full object-cover"
                        alt="Recipes">
                </div>
            </div>

            <div
                class="flex flex-col md:flex-row items-center justify-between bg-cardGray p-6 md:p-8 rounded-[2rem] gap-8 hover:scale-[1.01] transition-transform duration-300">
                <div class="text-left flex-1 order-2 md:order-1">
                    <h3 class="text-2xl font-bold text-slate-800 mb-3">Workouts</h3>
                    <p class="text-slate-600 mb-6 leading-relaxed">Evidence-based training routines from beginner to
                        advanced levels to help you reach your goals.</p>
                    <a href="{{ route('workouts') }}"
                        class="inline-block bg-[#1fa463] text-white px-8 py-3 rounded-full text-sm font-bold hover:bg-green-700 transition shadow-md shadow-green-900/10">
                        View Full Plan
                    </a>
                </div>
                <div class="w-full md:w-48 h-48 rounded-2xl overflow-hidden order-1 md:order-2 shadow-inner">
                    <img src="../images/karsten-winegeart-0Wra5YYVQJE-unsplash.jpg" class="w-full h-full object-cover"
                        alt="Workouts">
                </div>
            </div>

        </div>
    </section>
@endsection
