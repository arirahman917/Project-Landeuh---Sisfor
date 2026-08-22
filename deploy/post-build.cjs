// Script post-build: menyalin file penting ke public/build/
// agar auto-deploy Hostinger ikut menyalinnya ke public_html
const fs = require('fs');
const path = require('path');

const root = path.resolve(__dirname, '..');
const buildDir = path.join(root, 'public', 'build');

// Pastikan folder public/build ada
if (!fs.existsSync(buildDir)) {
    fs.mkdirSync(buildDir, { recursive: true });
}

// Copy index.php khusus Hostinger
fs.copyFileSync(
    path.join(root, 'deploy', 'hostinger-index.php'),
    path.join(buildDir, 'index.php')
);

// Copy .htaccess khusus Hostinger
fs.copyFileSync(
    path.join(root, 'deploy', 'hostinger-htaccess'),
    path.join(buildDir, '.htaccess')
);

console.log('✅ File deploy Hostinger berhasil disalin ke public/build/');
console.log('   - index.php (dengan path ../laravel/)');
console.log('   - .htaccess (versi Laravel lengkap)');
