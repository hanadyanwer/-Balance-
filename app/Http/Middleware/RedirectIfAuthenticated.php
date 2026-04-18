<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::guard($guard)->user();

                // إذا كان admin، توجيه لصفحة الإدارة
                if ($user->is_admin) {
                    return redirect('/admin/dashboard');
                }

                // إذا لم يكمل الملف الشخصي، توجيه لصفحة Setup
                if (!$user->profile_completed) {
                    return redirect()->route('profile.setup');
                }

                // إذا كان الملف مكتمل، توجيه للصفحة الرئيسية
                return redirect(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }
}
