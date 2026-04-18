@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-6">
    <h1 class="text-3xl font-bold text-gray-800">Dashboard</h1>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-blue-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Total Users</p>
                    <p class="text-3xl font-bold text-gray-800 mt-1">{{ $stats['users'] }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-users text-blue-500 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-green-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Total Recipes</p>
                    <p class="text-3xl font-bold text-gray-800 mt-1">{{ $stats['recipes'] }}</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-utensils text-green-500 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-orange-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Total Workouts</p>
                    <p class="text-3xl font-bold text-gray-800 mt-1">{{ $stats['workouts'] }}</p>
                </div>
                <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-dumbbell text-orange-500 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-purple-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Total Tips</p>
                    <p class="text-3xl font-bold text-gray-800 mt-1">{{ $stats['tips'] }}</p>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-lightbulb text-purple-500 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-xl shadow-lg p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Quick Actions</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <a href="{{ route('admin.recipes.create') }}" class="flex items-center gap-3 px-6 py-4 bg-gradient-to-r from-primary to-primaryDark text-white rounded-lg hover:shadow-lg transition">
                <i class="fas fa-plus-circle text-2xl"></i>
                <span class="font-semibold">Add New Recipe</span>
            </a>
            <a href="{{ route('admin.workouts.create') }}" class="flex items-center gap-3 px-6 py-4 bg-gradient-to-r from-orange-500 to-orange-600 text-white rounded-lg hover:shadow-lg transition">
                <i class="fas fa-plus-circle text-2xl"></i>
                <span class="font-semibold">Add New Workout</span>
            </a>
            <a href="{{ route('admin.tips.create') }}" class="flex items-center gap-3 px-6 py-4 bg-gradient-to-r from-purple-500 to-purple-600 text-white rounded-lg hover:shadow-lg transition">
                <i class="fas fa-plus-circle text-2xl"></i>
                <span class="font-semibold">Add New Tip</span>
            </a>
        </div>
    </div>
</div>
@endsection
