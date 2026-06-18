<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$accs = App\Models\Accommodation::all();
foreach($accs as $acc) {
    $gambar = $acc->getRawOriginal('gambar');
    if ($gambar) {
        $acc->gambar = str_replace('.png', '.webp', $gambar);
        $acc->save();
        echo "Updated accommodation ID: {$acc->id}\n";
    }
}
echo "Done updating accommodations.\n";
