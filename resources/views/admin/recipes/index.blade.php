@extends('admin.layout')

@section('title', 'Recipes Management')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">
                Recipes Management
                @if(isset($mealType))
                    <span class="text-2xl text-primary">- {{ ucfirst($mealType) }}</span>
                @endif
            </h1>
            <div class="flex gap-2 mt-3">
                <a href="{{ route('admin.recipes.index') }}" class="px-4 py-2 text-sm {{ !isset($mealType) ? 'bg-primary text-white' : 'bg-gray-100 text-gray-700' }} rounded-lg hover:bg-primary hover:text-white transition">
                    All
                </a>
                <a href="{{ route('admin.recipes.index', ['meal_type' => 'breakfast']) }}" class="px-4 py-2 text-sm {{ isset($mealType) && $mealType == 'breakfast' ? 'bg-primary text-white' : 'bg-gray-100 text-gray-700' }} rounded-lg hover:bg-primary hover:text-white transition">
                    Breakfast
                </a>
                <a href="{{ route('admin.recipes.index', ['meal_type' => 'lunch']) }}" class="px-4 py-2 text-sm {{ isset($mealType) && $mealType == 'lunch' ? 'bg-primary text-white' : 'bg-gray-100 text-gray-700' }} rounded-lg hover:bg-primary hover:text-white transition">
                    Lunch
                </a>
                <a href="{{ route('admin.recipes.index', ['meal_type' => 'dinner']) }}" class="px-4 py-2 text-sm {{ isset($mealType) && $mealType == 'dinner' ? 'bg-primary text-white' : 'bg-gray-100 text-gray-700' }} rounded-lg hover:bg-primary hover:text-white transition">
                    Dinner
                </a>
                <a href="{{ route('admin.recipes.index', ['meal_type' => 'snack']) }}" class="px-4 py-2 text-sm {{ isset($mealType) && $mealType == 'snack' ? 'bg-primary text-white' : 'bg-gray-100 text-gray-700' }} rounded-lg hover:bg-primary hover:text-white transition">
                    Snack
                </a>
            </div>
        </div>
        <a href="{{ route('admin.recipes.create') }}" class="px-6 py-3 bg-primary text-white rounded-lg hover:bg-primaryDark transition flex items-center gap-2">
            <i class="fas fa-plus"></i>
            <span>Add New Recipe</span>
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Meal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Meal Type</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nutrition Profile</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Energy</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($recipes as $recipe)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center gap-4">
                            @if($recipe->image)
                                <img src="{{ asset($recipe->image) }}" alt="{{ $recipe->name }}" class="w-16 h-16 object-cover rounded-lg shadow-sm">
                            @else
                                <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-image text-gray-400"></i>
                                </div>
                            @endif
                            <div class="text-sm font-medium text-gray-900">{{ $recipe->name }}</div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800 capitalize">
                            {{ $recipe->meal_type }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-xs text-gray-600 font-medium">
                            Prot: {{ $recipe->protein ?? '0' }}g | Carbs: {{ $recipe->carbs ?? '0' }}g | Fats: {{ $recipe->fats ?? '0' }}g
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-3 py-1 bg-emerald-50 text-emerald-600 rounded-full text-xs font-bold">{{ $recipe->calories ?? 'N/A' }} kcal</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                        <a href="{{ route('admin.recipes.edit', $recipe) }}" class="text-primary hover:text-primaryDark">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('admin.recipes.destroy', $recipe) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this recipe?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                        No recipes found. <a href="{{ route('admin.recipes.create') }}" class="text-primary hover:underline">Create one</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        @if(isset($mealType))
            {{ $recipes->appends(['meal_type' => $mealType])->links() }}
        @else
            {{ $recipes->links() }}
        @endif
    </div>
</div>
@endsection
