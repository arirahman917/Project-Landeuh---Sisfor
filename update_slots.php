<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

foreach (\App\Models\CorporatePackage::all() as $pkg) {
    $slot = \App\Models\Accommodation::whereIn('id', $pkg->accommodation_ids ?? [])->sum('slot');
    $pkg->update(['slot' => $slot]);
}
echo "Done\n";
