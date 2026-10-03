<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        'login',
        '*/login',
        'admin/login',
        'receptionist/login',
        'doctor/login',
        'nurse/login',
        'accountant/login',
        'pharmacist/login',
        'labEmployee/login',
        'rayEmployee/login',
        'patient/login',
        '*/register',
    ];
}
