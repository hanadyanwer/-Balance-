<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Show the profile setup page (للمستخدمين الجدد)
     */
    public function showSetup()
    {
        $user = Auth::user();

        // السماح بالوصول للصفحة حتى لو كان الملف مكتمل (للتعديل)
        return view('profile.setup', compact('user'));
    }

    /**
     * Save profile setup data (أول مرة)
     */
    public function saveSetup(Request $request)
    {
        $validated = $request->validate([
            'weight' => 'required|numeric|min:30|max:300',
            'height' => 'required|numeric|min:100|max:250',
            'age' => 'required|integer|min:13|max:100',
            'gender' => 'required|in:male,female',
            'health_goal' => 'required|in:lose_weight,gain_weight,build_muscle,maintain',
        ], [
            'weight.required' => 'Weight is required',
            'weight.min' => 'Weight must be at least 30 kg',
            'weight.max' => 'Weight must be less than 300 kg',
            'height.required' => 'Height is required',
            'height.min' => 'Height must be at least 100 cm',
            'height.max' => 'Height must be less than 250 cm',
            'age.required' => 'Age is required',
            'age.min' => 'Age must be at least 13 years',
            'age.max' => 'Age must be less than 100 years',
            'gender.required' => 'Gender is required',
            'health_goal.required' => 'Health goal is required',
        ]);

        $user = Auth::user();

        // حساب BMI
        $heightInMeters = $validated['height'] / 100;
        $bmi = round($validated['weight'] / ($heightInMeters * $heightInMeters), 2);

        // تحديث بيانات المستخدم
        $user->update([
            'weight' => $validated['weight'],
            'height' => $validated['height'],
            'age' => $validated['age'],
            'gender' => $validated['gender'],
            'health_goal' => $validated['health_goal'],
            'bmi' => $bmi,
            'profile_completed' => true,
        ]);

        return redirect()->route('home')->with('profile_success', 'Your profile has been saved successfully! 🎉');
    }

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
            'health_goal' => 'nullable|string|in:lose_weight,gain_weight,build_muscle,maintain',
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

                // حساب العمر
                $validated['age'] = \Carbon\Carbon::parse($validated['date_of_birth'])->age;
            } catch (\Exception $e) {
                // Invalid date, skip
            }
        }

        // Remove individual date fields
        unset($validated['dob_month'], $validated['dob_day'], $validated['dob_year']);

        // حساب BMI إذا تم تحديث الوزن أو الطول
        if (isset($validated['weight']) && isset($validated['height']) && $validated['height'] > 0) {
            $heightInMeters = $validated['height'] / 100;
            $validated['bmi'] = round($validated['weight'] / ($heightInMeters * $heightInMeters), 2);
        } elseif (isset($validated['weight']) && $user->height > 0) {
            $heightInMeters = $user->height / 100;
            $validated['bmi'] = round($validated['weight'] / ($heightInMeters * $heightInMeters), 2);
        } elseif (isset($validated['height']) && $user->weight > 0 && $validated['height'] > 0) {
            $heightInMeters = $validated['height'] / 100;
            $validated['bmi'] = round($user->weight / ($heightInMeters * $heightInMeters), 2);
        }

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

        // Check if it's an AJAX request
        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Profile updated successfully!',
                'user' => $user
            ]);
        }

        return redirect()->route('profile')->with('success', 'Profile updated successfully!');
    }
}
