<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureProfileIsComplete
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        // إذا كان المستخدم مسجل دخول وليس admin ولم يكمل ملفه الشخصي
        if ($user && !$user->is_admin && !$user->profile_completed) {
            // السماح بالوصول لصفحة setup و logout
            if (!$request->routeIs('profile.setup', 'profile.setup.save', 'logout')) {
                return redirect()->route('profile.setup');
            }
        }

        return $next($request);
    }
}
