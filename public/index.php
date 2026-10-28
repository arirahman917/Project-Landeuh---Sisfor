<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
/** @var Application $app */
// Force clear all caches on Hostinger to ensure new routes & config take effect
$cacheFlag = __DIR__.'/../storage/framework/views/.cleared_v8';
if (!file_exists($cacheFlag)) {
    // Clear view cache
    $views = glob(__DIR__.'/../storage/framework/views/*.php');
    if ($views) foreach ($views as $v) @unlink($v);
    // Clear route cache
    $routes = glob(__DIR__.'/../bootstrap/cache/routes*.php');
    if ($routes) foreach ($routes as $r) @unlink($r);
    // Clear config cache
    $configCache = __DIR__.'/../bootstrap/cache/config.php';
    if (file_exists($configCache)) @unlink($configCache);
    // Clear OPcache
    if (function_exists('opcache_reset')) @opcache_reset();
    @file_put_contents($cacheFlag, '1');
}

$app = require_once __DIR__.'/../bootstrap/app.php';

$app->handleRequest(Request::capture());
