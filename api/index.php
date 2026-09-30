<?php

// Prepare writable temporary storage directories on Vercel read-only filesystem
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

// Set environment variables for temporary directories
$_ENV["APP_CONFIG_CACHE"] = "/tmp/config.php";
$_ENV["APP_EVENTS_CACHE"] = "/tmp/events.php";
$_ENV["APP_PACKAGES_CACHE"] = "/tmp/packages.php";
$_ENV["APP_ROUTES_CACHE"] = "/tmp/routes.php";
$_ENV["APP_SERVICES_CACHE"] = "/tmp/services.php";
$_ENV["VIEW_COMPILED_PATH"] = "/tmp/storage/framework/views";
$_ENV["CACHE_DRIVER"] = "array";
$_ENV["LOG_CHANNEL"] = "stderr";
$_ENV["SESSION_DRIVER"] = "cookie";

putenv("APP_CONFIG_CACHE=/tmp/config.php");
putenv("APP_EVENTS_CACHE=/tmp/events.php");
putenv("APP_PACKAGES_CACHE=/tmp/packages.php");
putenv("APP_ROUTES_CACHE=/tmp/routes.php");
putenv("APP_SERVICES_CACHE=/tmp/services.php");
putenv("VIEW_COMPILED_PATH=/tmp/storage/framework/views");

require __DIR__ . "/../vendor/autoload.php";

$app = require_once __DIR__ . "/../bootstrap/app.php";

// Set storage path to writable /tmp/storage
$app->useStoragePath("/tmp/storage");

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
)->send();

$kernel->terminate($request, $response);

