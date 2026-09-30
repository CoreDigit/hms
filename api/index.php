<?php

ini_set("display_errors", "1");
ini_set("display_startup_errors", "1");
error_reporting(E_ALL);

try {
    $basePath = dirname(__DIR__);

    // 1. Prepare writable temporary storage directories in /tmp
    $storageDirs = [
        "/tmp/storage/framework/views",
        "/tmp/storage/framework/cache/data",
        "/tmp/storage/framework/sessions",
        "/tmp/storage/logs",
        "/tmp/storage/app/public",
    ];

    foreach ($storageDirs as $dir) {
        if (!is_dir($dir)) {
            @mkdir($dir, 0777, true);
        }
    }

    // 2. Set environment variables for temporary directories
    $_ENV["APP_CONFIG_CACHE"] = "/tmp/config.php";
    $_ENV["APP_EVENTS_CACHE"] = "/tmp/events.php";
    $_ENV["APP_PACKAGES_CACHE"] = "/tmp/packages.php";
    $_ENV["APP_ROUTES_CACHE"] = "/tmp/routes.php";
    $_ENV["APP_SERVICES_CACHE"] = "/tmp/services.php";
    $_ENV["VIEW_COMPILED_PATH"] = "/tmp/storage/framework/views";

    putenv("APP_CONFIG_CACHE=/tmp/config.php");
    putenv("APP_EVENTS_CACHE=/tmp/events.php");
    putenv("APP_PACKAGES_CACHE=/tmp/packages.php");
    putenv("APP_ROUTES_CACHE=/tmp/routes.php");
    putenv("APP_SERVICES_CACHE=/tmp/services.php");
    putenv("VIEW_COMPILED_PATH=/tmp/storage/framework/views");

    // APP_KEY fallback if not set in Vercel settings
    if (empty($_ENV["APP_KEY"]) && empty(getenv("APP_KEY"))) {
        $_ENV["APP_KEY"] = "base64:HfjYTjwrTTQ3vt5vGnMnb3pz8mLiPCfgeRGS8pwozSw=";
        putenv("APP_KEY=base64:HfjYTjwrTTQ3vt5vGnMnb3pz8mLiPCfgeRGS8pwozSw=");
    }

    // Fallback SQLite database in /tmp if DB_HOST is not configured or pointing to local
    $dbHost = $_ENV["DB_HOST"] ?? getenv("DB_HOST");
    if (empty($dbHost) || $dbHost === "127.0.0.1" || $dbHost === "localhost") {
        $sqliteFile = "/tmp/database.sqlite";
        if (!file_exists($sqliteFile)) {
            touch($sqliteFile);
        }
        $_ENV["DB_CONNECTION"] = "sqlite";
        $_ENV["DB_DATABASE"] = $sqliteFile;
        putenv("DB_CONNECTION=sqlite");
        putenv("DB_DATABASE=" . $sqliteFile);
    }

    require $basePath . "/vendor/autoload.php";

    $app = require_once $basePath . "/bootstrap/app.php";

    // Set storage path to writable /tmp/storage
    $app->useStoragePath("/tmp/storage");

    $kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

    $response = $kernel->handle(
        $request = Illuminate\Http\Request::capture()
    );

    $response->send();
    $kernel->terminate($request, $response);
} catch (\Throwable $e) {
    http_response_code(500);
    echo "<div style=\"font-family: sans-serif; padding: 30px; background: #fff3f3; color: #900; border: 1px solid #f99; border-radius: 8px;\">";
    echo "<h2 style=\"margin-top:0;\">?? Laravel Serverless Error Diagnostic</h2>";
    echo "<p><strong>Message:</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
    echo "<p><strong>File:</strong> " . htmlspecialchars($e->getFile()) . ":" . $e->getLine() . "</p>";
    echo "<details open><summary><strong>Stack Trace:</strong></summary><pre style=\"white-space: pre-wrap; font-size: 12px; margin-top: 10px; background: #eee; padding: 10px;\">" . htmlspecialchars($e->getTraceAsString()) . "</pre></details>";
    echo "</div>";
}

