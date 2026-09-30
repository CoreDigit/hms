<?php

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

// 3. APP_KEY fallback if not set in Vercel settings
if (empty($_ENV["APP_KEY"]) && empty(getenv("APP_KEY"))) {
    $_ENV["APP_KEY"] = "base64:HfjYTjwrTTQ3vt5vGnMnb3pz8mLiPCfgeRGS8pwozSw=";
    putenv("APP_KEY=base64:HfjYTjwrTTQ3vt5vGnMnb3pz8mLiPCfgeRGS8pwozSw=");
}

// 4. Fallback SQLite database in /tmp if DB_HOST is not configured or pointing to local
$dbHost = $_ENV["DB_HOST"] ?? getenv("DB_HOST");
if (empty($dbHost) || $dbHost === "127.0.0.1" || $dbHost === "localhost") {
    $sqliteFile = "/tmp/database.sqlite";
    if (!file_exists($sqliteFile) || filesize($sqliteFile) === 0) {
        touch($sqliteFile);
    }
    $_ENV["DB_CONNECTION"] = "sqlite";
    $_ENV["DB_DATABASE"] = $sqliteFile;
    putenv("DB_CONNECTION=sqlite");
    putenv("DB_DATABASE=" . $sqliteFile);
}

require __DIR__ . "/../public/index.php";

