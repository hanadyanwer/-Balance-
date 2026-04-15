<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|unique:users,email,' . $user->id,
            'dob_month' => 'nullable|integer|min:1|max:12',
            'dob_day' => 'nullable|integer|min:1|max:31',
            'dob_year' => 'nullable|integer|min:1900|max:2030',
            'gender' => 'nullable|in:male,female',
            'weight' => 'nullable|numeric|min:0|max:500',
            'height' => 'nullable|numeric|min:0|max:300',
            'health_goal' => 'nullable|string|in:lose,gain,maintain',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'cover_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Combine date of birth
        if ($request->filled(['dob_year', 'dob_month', 'dob_day'])) {
            try {
                $date = \Carbon\Carbon::createFromDate(
                    $request->dob_year,
                    $request->dob_month,
                    $request->dob_day
                );
                $validated['date_of_birth'] = $date->format('Y-m-d');
            } catch (\Exception $e) {
                // Invalid date, skip
            }
        }

        // Remove individual date fields
        unset($validated['dob_month'], $validated['dob_day'], $validated['dob_year']);

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::delete('public/' . $user->avatar);
            }
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $validated['avatar'] = $avatarPath;
        }

        // Handle cover photo upload
        if ($request->hasFile('cover_photo')) {
            if ($user->cover_photo) {
                Storage::delete('public/' . $user->cover_photo);
            }
            $coverPath = $request->file('cover_photo')->store('covers', 'public');
            $validated['cover_photo'] = $coverPath;
        }

        $user->update($validated);

        return redirect()->route('profile')->with('success', 'Profile updated successfully!');
    }
}
