<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

// Check for null/zero slot values
$items = App\Models\Accommodation::all();
foreach ($items as $a) {
    echo "ID {$a->id} | slot={$a->slot} | max_orang={$a->max_orang}" . PHP_EOL;
}

// Also check if any booking has NULL check_in_date or check_out_date
echo PHP_EOL . "=== Bookings with potential issues ===" . PHP_EOL;
$bookings = App\Models\Booking::where('status', '!=', 'failed')
    ->whereNull('check_in_date')
    ->orWhereNull('check_out_date')
    ->get();

echo "Bookings with null dates: " . $bookings->count() . PHP_EOL;

// Check if Booking model has date casts
echo PHP_EOL . "=== Booking model casts ===" . PHP_EOL;
$b = new App\Models\Booking();
echo "Casts: " . json_encode($b->getCasts()) . PHP_EOL;
