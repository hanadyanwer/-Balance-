@extends('admin.layout')

@section('title', 'Edit Workout')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.workouts.index') }}" class="text-gray-600 hover:text-gray-800">
            <i class="fas fa-arrow-left text-xl"></i>
        </a>
        <h1 class="text-3xl font-bold text-gray-800">Edit Workout</h1>
    </div>

    <form action="{{ route('admin.workouts.update', $workout) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-xl shadow-lg p-8 space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Workout Name *</label>
                <input type="text" name="name" value="{{ old('name', $workout->name) }}" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Type *</label>
                <select name="type" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                    <option value="">Select type</option>
                    <option value="cardio" {{ old('type', $workout->type) == 'cardio' ? 'selected' : '' }}>Cardio</option>
                    <option value="strength" {{ old('type', $workout->type) == 'strength' ? 'selected' : '' }}>Strength</option>
                    <option value="flexibility" {{ old('type', $workout->type) == 'flexibility' ? 'selected' : '' }}>Flexibility</option>
                    <option value="balance" {{ old('type', $workout->type) == 'balance' ? 'selected' : '' }}>Balance</option>
                    <option value="hiit" {{ old('type', $workout->type) == 'hiit' ? 'selected' : '' }}>HIIT</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Duration (minutes)</label>
                <input type="number" name="duration" value="{{ old('duration', $workout->duration) }}" min="0"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Difficulty *</label>
                <select name="difficulty" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                    <option value="beginner" {{ old('difficulty', $workout->difficulty) == 'beginner' ? 'selected' : '' }}>Beginner</option>
                    <option value="intermediate" {{ old('difficulty', $workout->difficulty) == 'intermediate' ? 'selected' : '' }}>Intermediate</option>
                    <option value="advanced" {{ old('difficulty', $workout->difficulty) == 'advanced' ? 'selected' : '' }}>Advanced</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Calories Burned</label>
                <input type="number" name="calories_burned" value="{{ old('calories_burned', $workout->calories_burned) }}" min="0"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Equipment</label>
                <input type="text" name="equipment" value="{{ old('equipment', $workout->equipment) }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Image</label>
                @if($workout->image)
                    <img src="{{ asset($workout->image) }}" alt="{{ $workout->name }}" class="w-32 h-32 object-cover rounded-lg mb-2 shadow-sm">
                @endif
                <input type="file" name="image" accept="image/*"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fa-brands fa-youtube text-red-500"></i> Video URL (YouTube)
                </label>
                <input type="url" name="video_url" value="{{ old('video_url', $workout->video_url) }}" placeholder="https://www.youtube.com/watch?v=..."
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                <p class="text-xs text-gray-500 mt-1">Enter a YouTube video URL for this workout</p>
                @if($workout->video_url)
                    <a href="{{ $workout->video_url }}" target="_blank" class="inline-flex items-center gap-2 text-sm text-primary hover:text-primaryDark mt-2">
                        <i class="fa-solid fa-play"></i>
                        <span>Watch Current Video</span>
                    </a>
                @endif
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
            <textarea name="description" rows="3"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">{{ old('description', $workout->description) }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Instructions</label>
            <textarea name="instructions" rows="5"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">{{ old('instructions', $workout->instructions) }}</textarea>
        </div>

        <div class="flex gap-4">
            <button type="submit" class="px-6 py-3 bg-primary text-white rounded-lg hover:bg-primaryDark transition">
                <i class="fas fa-save"></i> Update Workout
            </button>
            <a href="{{ route('admin.workouts.index') }}" class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
