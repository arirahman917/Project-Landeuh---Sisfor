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

// Force clear all caches on Hostinger to ensure new routes & config take effect
$cacheFlag = __DIR__.'/../laravel/storage/framework/views/.cleared_v3';
if (!file_exists($cacheFlag)) {
    // Clear view cache
    $views = glob(__DIR__.'/../laravel/storage/framework/views/*.php');
    if ($views) foreach ($views as $v) @unlink($v);
    // Clear route cache
    $routeCache = __DIR__.'/../laravel/bootstrap/cache/routes-v7.php';
    if (file_exists($routeCache)) @unlink($routeCache);
    // Clear config cache
    $configCache = __DIR__.'/../laravel/bootstrap/cache/config.php';
    if (file_exists($configCache)) @unlink($configCache);
    // Clear OPcache
    if (function_exists('opcache_reset')) @opcache_reset();
    @file_put_contents($cacheFlag, '1');
}

// Adjust public path for Hostinger deployment
$app->usePublicPath(__DIR__);

$app->handleRequest(Request::capture());
