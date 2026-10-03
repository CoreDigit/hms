<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $allGuards = !empty($guards) && $guards[0] !== null ? $guards : [
            'admin', 'doctor', 'patient', 'rayEmployee', 'labEmployee', 
            'receptionist', 'nurse', 'accountant', 'pharmacist', 'web'
        ];

        foreach ($allGuards as $guard) {
            if (Auth::guard($guard)->check()) {
                $target = RouteServiceProvider::HOME[$guard] ?? '/';
                return redirect($target);
            }
        }

        return $next($request);
    }
}
