<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Session\TokenMismatchException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        "current_password",
        "password",
        "password_confirmation",
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        $this->renderable(function (TokenMismatchException $e, $request) {
            if ($request->is('*/logout') || $request->is('logout')) {
                foreach (['admin', 'doctor', 'patient', 'receptionist', 'nurse', 'accountant', 'pharmacist', 'labEmployee', 'rayEmployee'] as $guard) {
                    if (auth()->guard($guard)->check()) {
                        auth()->guard($guard)->logout();
                    }
                }
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect('/');
            }

            if ($request->expectsJson()) {
                return response()->json(['message' => 'Session expired. Please refresh the page and try again.'], 419);
            }

            return redirect()->back()
                ->withInput($request->except($this->dontFlash))
                ->with('error', __('Session expired. Please try again.'));
        });
    }
}

