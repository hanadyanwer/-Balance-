@extends('admin.layout')

@section('title', 'Edit Tip')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.tips.index') }}" class="text-gray-600 hover:text-gray-800">
            <i class="fas fa-arrow-left text-xl"></i>
        </a>
        <h1 class="text-3xl font-bold text-gray-800">Edit Tip</h1>
    </div>

    <form action="{{ route('admin.tips.update', $tip) }}" method="POST" class="bg-white rounded-xl shadow-lg p-8 space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Title *</label>
            <input type="text" name="title" value="{{ old('title', $tip->title) }}" required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Category *</label>
            <select name="category" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                <option value="">Select category</option>
                <option value="nutrition" {{ old('category', $tip->category) == 'nutrition' ? 'selected' : '' }}>Nutrition</option>
                <option value="fitness" {{ old('category', $tip->category) == 'fitness' ? 'selected' : '' }}>Fitness</option>
                <option value="wellness" {{ old('category', $tip->category) == 'wellness' ? 'selected' : '' }}>Wellness</option>
                <option value="mental_health" {{ old('category', $tip->category) == 'mental_health' ? 'selected' : '' }}>Mental Health</option>
                <option value="sleep" {{ old('category', $tip->category) == 'sleep' ? 'selected' : '' }}>Sleep</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Content *</label>
            <textarea name="content" rows="6" required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">{{ old('content', $tip->content) }}</textarea>
        </div>

        <div class="flex gap-4">
            <button type="submit" class="px-6 py-3 bg-primary text-white rounded-lg hover:bg-primaryDark transition">
                <i class="fas fa-save"></i> Update Tip
            </button>
            <a href="{{ route('admin.tips.index') }}" class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
