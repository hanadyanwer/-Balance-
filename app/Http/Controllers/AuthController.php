<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function showSignup()
    {
        return view('signup');
    }

    public function showAdminLogin()
    {
        return view('admainlog');
    }

    public function login(Request $request)
    {
        // معالجة تسجيل الدخول
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // منع الأدمن من تسجيل الدخول من الصفحة العادية
            if (Auth::user()->is_admin) {
                Auth::logout();
                $request->session()->invalidate();
                return back()->withErrors([
                    'email' => 'هذا الحساب للمسؤولين فقط. الرجاء استخدام صفحة تسجيل دخول الأدمن.'
                ])->withInput($request->only('email'));
            }

            return redirect()->route('home')->with('success', 'تم تسجيل الدخول بنجاح!');
        }

        return back()->withErrors(['email' => 'بيانات الدخول غير صحيحة']);
    }

    public function signup(Request $request)
    {
        // معالجة التسجيل
        $validated = $request->validate([
            'fullName' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $validated['fullName'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // Create notification for admin
        Notification::create([
            'type' => 'user_registered',
            'title' => 'New User Registered',
            'message' => "New user {$user->name} has registered.",
            'link' => null,
            'is_read' => false,
        ]);

        Auth::login($user);

        return redirect()->route('home')->with('success', 'تم إنشاء الحساب بنجاح!');
    }

    public function logout(Request $request)
    {
        // معالجة تسجيل الخروج
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('index')->with('success', 'تم تسجيل الخروج بنجاح!');
    }

    public function adminLogin(Request $request)
    {
        // معالجة تسجيل دخول الأدمن
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // التحقق من أن المستخدم أدمن
            if (Auth::user()->is_admin) {
                return redirect()->route('admin.dashboard')->with('success', 'Welcome Admin!');
            }

            // إذا ليس أدمن، تسجيل الخروج وإرجاع رسالة خطأ
            Auth::logout();
            return back()->withErrors(['email' => 'This account does not have admin privileges.']);
        }

        return back()->withErrors(['email' => 'Invalid admin credentials.']);
    }
}
