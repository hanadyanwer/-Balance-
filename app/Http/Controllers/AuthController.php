<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

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

    public function showForgotPassword()
    {
        return view('forgot-password');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->withErrors(['email' => 'The email is not registered in the system.']);
        }

        // Generate 6-digit code
        $code = rand(100000, 999999);

        // Save in session for verification
        session(['reset_email' => $request->email, 'reset_code' => $code]);

        // Save in password_reset_tokens table
        \DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            ['token' => Hash::make($code), 'created_at' => now()]
        );

        // Send email with the code
        Mail::raw("Your password reset code is: $code", function ($message) use ($request) {
            $message->to($request->email)
                    ->subject('Password Reset Code');
        });

        return redirect()->route('password.enter-code')->with('status', 'Code sent successfully. Enter the sent code.');
    }

    public function showEnterCode()
    {
        if (!session('reset_email')) {
            return redirect()->route('password.request');
        }
        return view('enter-code');
    }

    public function verifyCode(Request $request)
    {
        $request->validate(['code' => 'required|string']);

        if ($request->code !== session('reset_code')) {
            return back()->withErrors(['code' => 'The code is incorrect.']);
        }

        // Code is correct, redirect to reset-password
        return redirect()->route('password.reset', ['token' => 'verified']);
    }

    public function showResetForm($token)
    {
        return view('reset-password', ['token' => $token]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:8|confirmed',
        ]);

        $email = session('reset_email');
        $code = session('reset_code');

        // Verify the code from the database
        $resetRecord = \DB::table('password_reset_tokens')->where('email', $email)->first();
        if (!$resetRecord || !Hash::check($code, $resetRecord->token)) {
            return back()->withErrors(['password' => 'Invalid reset code.']);
        }

        // Update password
        $user = User::where('email', $email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        // Clean up
        \DB::table('password_reset_tokens')->where('email', $email)->delete();
        session()->forget(['reset_email', 'reset_code']);

        return redirect()->route('login')->with('status', 'Password changed successfully!');
    }
}
