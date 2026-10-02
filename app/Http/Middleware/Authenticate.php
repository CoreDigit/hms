<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if (! $request->expectsJson()) {
            if ($request->is('*/admin*')) return route('admin.login');
            if ($request->is('*/doctor*')) return route('doctor.login');
            if ($request->is('*/receptionist*')) return route('receptionist.login');
            if ($request->is('*/nurse*')) return route('nurse.login');
            if ($request->is('*/accountant*')) return route('accountant.login');
            if ($request->is('*/pharmacist*')) return route('pharmacist.login');
            if ($request->is('*/labEmployee*')) return route('labEmployee.login');
            if ($request->is('*/rayEmployee*')) return route('rayEmployee.login');
            if ($request->is('*/patient*')) return route('patient.login');
            return route('login');
        }
        return null;
    }
}
