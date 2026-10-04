<?php

if (!function_exists('activeGuard')) {
    function activeGuard(): string {
        foreach (['admin', 'doctor', 'patient', 'receptionist', 'nurse', 'accountant', 'pharmacist', 'labEmployee', 'rayEmployee'] as $guard) {
            if (auth()->guard($guard)->check()) {
                return $guard;
            }
        }
        return 'admin';
    }
}

if (!function_exists('activeUser')) {
    function activeUser() {
        $guard = activeGuard();
        return auth()->guard($guard)->user();
    }
}
