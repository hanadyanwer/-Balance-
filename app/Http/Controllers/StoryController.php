<?php

namespace App\Http\Controllers;

use App\Models\Story;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'story' => 'required|string|min:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240'
        ]);

        $data = [
            'user_id' => Auth::id(),
            'name' => $request->name,
            'title' => $request->title,
            'story' => $request->story,
            'is_approved' => false
        ];

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $data['image'] = 'images/' . $imageName;
        }

        $story = Story::create($data);

        // Create notification for admin
        Notification::create([
            'type' => 'story_submitted',
            'title' => 'New Success Story Submitted',
            'message' => $request->name . ' shared their success story. Please review and approve.',
            'link' => route('admin.stories.index'),
            'is_read' => false
        ]);

        return redirect()->back()->with('story_success', 'success');
    }

    public function getApprovedStories()
    {
        return Story::where('is_approved', true)
            ->latest()
            ->get();
    }
}
