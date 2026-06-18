<?php
$dirs = ['resources', 'app', 'routes', 'database/seeders'];
function processDir($dir) {
    if (!is_dir($dir)) return;
    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));
    foreach ($iterator as $file) {
        if ($file->isFile() && $file->getExtension() === 'php') {
            $path = $file->getPathname();
            $content = file_get_contents($path);
            $originalContent = $content;
            
            // 1. Revert ALL .webp back to .png
            $content = str_replace('.webp', '.png', $content);
            
            // 2. Only change .png to .webp IF it's in the akomodasi folder
            // Matches e.g. "images/akomodasi/cabin1/a.png"
            $content = preg_replace('/(akomodasi[^\'"]*?)\.png/i', '$1.webp', $content);
            
            // Special case: in akomodasi_detail.blade.php, there's `const imgs=['a.png','b.png','c.png','d.png'];`
            // They belong to akomodasi. We'll manually fix them just in case they are used.
            if (strpos($path, 'akomodasi_detail.blade.php') !== false) {
                $content = str_replace("['a.png','b.png','c.png','d.png']", "['a.webp','b.webp','c.webp','d.webp']", $content);
            }
            
            if ($originalContent !== $content) {
                file_put_contents($path, $content);
                echo "Reverted/Fixed: $path\n";
            }
        }
    }
}

foreach ($dirs as $dir) {
    processDir($dir);
}
echo "Done.\n";
