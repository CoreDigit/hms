<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
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
    }

    public function render($request, Throwable $e)
    {
        if (env("APP_DEBUG", true)) {
            return response()->make("<div style=\"font-family:sans-serif;padding:30px;background:#fff0f0;color:#900;border:2px solid #f00;\"><h2>Laravel Error: " . htmlspecialchars($e->getMessage()) . "</h2><p><strong>File:</strong> " . htmlspecialchars($e->getFile()) . ":" . $e->getLine() . "</p><pre style=\"white-space:pre-wrap;font-size:12px;background:#eee;padding:15px;\">" . htmlspecialchars($e->getTraceAsString()) . "</pre></div>", 500);
        }

        return parent::render($request, $e);
    }
}

