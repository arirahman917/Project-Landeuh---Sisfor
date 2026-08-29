<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../laravel/storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../laravel/vendor/autoload.php';

// Bootstrap Laravel and handle the request...
/** @var Application $app */
$app = require_once __DIR__.'/../laravel/bootstrap/app.php';

// Adjust public path for Hostinger deployment
$app->usePublicPath(__DIR__);
app(\Illuminate\Foundation\Vite::class)->useBuildDirectory('');

$app->handleRequest(Request::capture());
