<?php

ini_set("display_errors", "1");
ini_set("display_startup_errors", "1");
error_reporting(E_ALL);

$basePath = dirname(__DIR__);

if (!file_exists($basePath . "/vendor/autoload.php")) {
    echo "<h1>Error: vendor/autoload.php not found at " . htmlspecialchars($basePath . "/vendor/autoload.php") . "</h1>";
    exit;
}

require $basePath . "/vendor/autoload.php";

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

putenv("APP_CONFIG_CACHE=/tmp/config.php");
putenv("APP_EVENTS_CACHE=/tmp/events.php");
putenv("APP_PACKAGES_CACHE=/tmp/packages.php");
putenv("APP_ROUTES_CACHE=/tmp/routes.php");
putenv("APP_SERVICES_CACHE=/tmp/services.php");
putenv("VIEW_COMPILED_PATH=/tmp/storage/framework/views");

$_ENV["APP_CONFIG_CACHE"] = "/tmp/config.php";
$_ENV["VIEW_COMPILED_PATH"] = "/tmp/storage/framework/views";

if (empty($_ENV["APP_KEY"]) && empty(getenv("APP_KEY"))) {
    $_ENV["APP_KEY"] = "base64:HfjYTjwrTTQ3vt5vGnMnb3pz8mLiPCfgeRGS8pwozSw=";
    putenv("APP_KEY=base64:HfjYTjwrTTQ3vt5vGnMnb3pz8mLiPCfgeRGS8pwozSw=");
}

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

$app = require_once $basePath . "/bootstrap/app.php";
$app->useStoragePath("/tmp/storage");

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();
$kernel->terminate($request, $response);

