@extends('admin.layout')

@section('title', 'Edit Recipe')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.recipes.index') }}" class="text-gray-600 hover:text-gray-800">
            <i class="fas fa-arrow-left text-xl"></i>
        </a>
        <h1 class="text-3xl font-bold text-gray-800">Edit Recipe</h1>
    </div>

    <form action="{{ route('admin.recipes.update', $recipe) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-xl shadow-lg p-8 space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Recipe Name *</label>
                <input type="text" name="name" value="{{ old('name', $recipe->name) }}" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Meal Type *</label>
                <select name="meal_type" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                    <option value="">Select meal type</option>
                    <option value="breakfast" {{ old('meal_type', $recipe->meal_type) == 'breakfast' ? 'selected' : '' }}>Breakfast</option>
                    <option value="lunch" {{ old('meal_type', $recipe->meal_type) == 'lunch' ? 'selected' : '' }}>Lunch</option>
                    <option value="snack" {{ old('meal_type', $recipe->meal_type) == 'snack' ? 'selected' : '' }}>Snack</option>
                    <option value="dinner" {{ old('meal_type', $recipe->meal_type) == 'dinner' ? 'selected' : '' }}>Dinner</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Calories</label>
                <input type="number" name="calories" value="{{ old('calories', $recipe->calories) }}" min="0"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Prep Time (minutes)</label>
                <input type="number" name="prep_time" value="{{ old('prep_time', $recipe->prep_time) }}" min="0"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Protein (g)</label>
                <input type="number" name="protein" value="{{ old('protein', $recipe->protein) }}" min="0"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Carbs (g)</label>
                <input type="number" name="carbs" value="{{ old('carbs', $recipe->carbs) }}" min="0"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Fats (g)</label>
                <input type="number" name="fats" value="{{ old('fats', $recipe->fats) }}" min="0"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Image</label>
                @if($recipe->image)
                    <img src="{{ asset($recipe->image) }}" alt="{{ $recipe->name }}" class="w-32 h-32 object-cover rounded-lg mb-2 shadow-sm">
                @endif
                <input type="file" name="image" accept="image/*"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
            <textarea name="description" rows="3"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">{{ old('description', $recipe->description) }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Ingredients</label>
            <textarea name="ingredients" rows="5"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">{{ old('ingredients', $recipe->ingredients) }}</textarea>
        </div>

        <div class="flex gap-4">
            <button type="submit" class="px-6 py-3 bg-primary text-white rounded-lg hover:bg-primaryDark transition">
                <i class="fas fa-save"></i> Update Recipe
            </button>
            <a href="{{ route('admin.recipes.index') }}" class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
