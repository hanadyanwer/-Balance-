@extends('admin.layout')

@section('title', 'Workouts Management')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold text-gray-800">Workouts Management</h1>
        <a href="{{ route('admin.workouts.create') }}" class="px-6 py-3 bg-primary text-white rounded-lg hover:bg-primaryDark transition flex items-center gap-2">
            <i class="fas fa-plus"></i>
            <span>Add New Workout</span>
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Duration</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Difficulty</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Calories</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Video</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($workouts as $workout)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ $workout->name }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-orange-100 text-orange-800 capitalize">
                            {{ $workout->type }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $workout->duration ?? 'N/A' }} min
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 text-xs font-semibold rounded-full
                            @if($workout->difficulty == 'beginner') bg-green-100 text-green-800
                            @elseif($workout->difficulty == 'intermediate') bg-yellow-100 text-yellow-800
                            @else bg-red-100 text-red-800 @endif capitalize">
                            {{ $workout->difficulty }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $workout->calories_burned ?? 'N/A' }} cal
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                        @if($workout->video_url)
                            <a href="{{ $workout->video_url }}" target="_blank" class="inline-flex items-center justify-center w-8 h-8 bg-red-100 text-red-600 rounded-full hover:bg-red-200 transition" title="Watch on YouTube">
                                <i class="fa-brands fa-youtube"></i>
                            </a>
                        @else
                            <span class="text-gray-300">
                                <i class="fa-solid fa-video-slash"></i>
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                        <a href="{{ route('admin.workouts.edit', $workout) }}" class="text-primary hover:text-primaryDark">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('admin.workouts.destroy', $workout) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?');">
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
                    <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                        No workouts found. <a href="{{ route('admin.workouts.create') }}" class="text-primary hover:underline">Create one</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $workouts->links() }}
    </div>
</div>
@endsection
