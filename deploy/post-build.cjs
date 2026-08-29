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

// Copy manifest ke folder build/ agar Laravel menemukannya di public_html/build/manifest.json
const manifestSrc = path.join(buildDir, 'manifest.json');
const nestedBuildDir = path.join(buildDir, 'build');
if (fs.existsSync(manifestSrc)) {
    fs.mkdirSync(nestedBuildDir, { recursive: true });
    fs.copyFileSync(manifestSrc, path.join(nestedBuildDir, 'manifest.json'));
}

// Copy .htaccess khusus Hostinger
fs.copyFileSync(
    path.join(root, 'deploy', 'hostinger-htaccess'),
    path.join(buildDir, '.htaccess')
);

// ── Copy folder public/images ke public/build/images ──
// Agar logo pembayaran, favicon, dll ikut tersalin ke public_html
function copyDirRecursive(src, dest) {
    if (!fs.existsSync(src)) return;
    if (!fs.existsSync(dest)) fs.mkdirSync(dest, { recursive: true });

    const entries = fs.readdirSync(src, { withFileTypes: true });
    for (const entry of entries) {
        const srcPath = path.join(src, entry.name);
        const destPath = path.join(dest, entry.name);
        if (entry.isDirectory()) {
            copyDirRecursive(srcPath, destPath);
        } else {
            fs.copyFileSync(srcPath, destPath);
        }
    }
}

copyDirRecursive(
    path.join(root, 'public', 'images'),
    path.join(buildDir, 'images')
);

// Copy folder public/js jika ada
copyDirRecursive(
    path.join(root, 'public', 'js'),
    path.join(buildDir, 'js')
);

// Copy robots.txt jika ada
const robotsSrc = path.join(root, 'public', 'robots.txt');
if (fs.existsSync(robotsSrc)) {
    fs.copyFileSync(robotsSrc, path.join(buildDir, 'robots.txt'));
}

// Copy favicon.ico jika ada
const faviconSrc = path.join(root, 'public', 'favicon.ico');
if (fs.existsSync(faviconSrc)) {
    fs.copyFileSync(faviconSrc, path.join(buildDir, 'favicon.ico'));
}

console.log('✅ File deploy Hostinger berhasil disalin ke public/build/');
console.log('   - index.php (dengan path ../laravel/)');
console.log('   - .htaccess (versi Laravel lengkap + PHP 8.4)');
console.log('   - images/ (logo pembayaran, logo landeuh, dll)');
console.log('   - js/, robots.txt, favicon.ico');
