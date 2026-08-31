<?php

// Script darurat untuk membersihkan cache di Hostinger
// Jalankan dengan mengunjungi: https://landeuhvillage.com/clear-cache.php

$routes = __DIR__.'/../bootstrap/cache/routes-v7.php';
$config = __DIR__.'/../bootstrap/cache/config.php';
$services = __DIR__.'/../bootstrap/cache/services.php';
$packages = __DIR__.'/../bootstrap/cache/packages.php';

$cleared = [];

if (file_exists($routes)) {
    unlink($routes);
    $cleared[] = 'Routes Cache';
}
if (file_exists($config)) {
    unlink($config);
    $cleared[] = 'Config Cache';
}
if (file_exists($services)) {
    unlink($services);
    $cleared[] = 'Services Cache';
}
if (file_exists($packages)) {
    unlink($packages);
    $cleared[] = 'Packages Cache';
}

if (function_exists('opcache_reset')) {
    opcache_reset();
    $cleared[] = 'OPcache';
}

echo "<h1>Cache Cleared Successfully!</h1>";
echo "<ul>";
foreach ($cleared as $item) {
    echo "<li>$item</li>";
}
echo "</ul>";
echo "<p>Sekarang coba verifikasi webhook di Meta lagi.</p>";
