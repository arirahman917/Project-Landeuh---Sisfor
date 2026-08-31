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

console.log('✅ File frontend & deploy Hostinger berhasil disalin ke public/build/');

// ══════════════════════════════════════════════════════════════════
// 🚀 AUTO-SYNC BACKEND LARAVEL PADA SETIAP DEPLOYMENT HOSTINGER
// ══════════════════════════════════════════════════════════════════
function findServerLaravelDir() {
    const candidates = [
        path.resolve(root, '..', 'laravel'),
        path.resolve(root, '..', '..', 'laravel'),
        path.resolve(root, '..', '..', '..', 'laravel'),
        '/home/u974535831/domains/landeuhvillage.com/laravel',
        '/home/u974535831/laravel',
    ];

    for (const candidate of candidates) {
        if (candidate !== root && fs.existsSync(candidate) && fs.existsSync(path.join(candidate, 'artisan'))) {
            return candidate;
        }
    }
    return null;
}

const serverLaravelDir = findServerLaravelDir();

if (serverLaravelDir) {
    console.log(`\n🔄 Ditemukan folder backend server di: ${serverLaravelDir}`);
    console.log('📦 Memulai sinkronisasi otomatis file backend...');

    // 1. Sync app/
    copyDirRecursive(path.join(root, 'app'), path.join(serverLaravelDir, 'app'));
    console.log('   - app/ (Controllers, Services, Models, dll) ✅');

    // 2. Sync routes/
    copyDirRecursive(path.join(root, 'routes'), path.join(serverLaravelDir, 'routes'));
    console.log('   - routes/ (web.php, api.php, admin.php, dll) ✅');

    // 3. Sync resources/views/
    copyDirRecursive(path.join(root, 'resources', 'views'), path.join(serverLaravelDir, 'resources', 'views'));
    console.log('   - resources/views/ (Blade templates) ✅');

    // 4. Sync config/
    copyDirRecursive(path.join(root, 'config'), path.join(serverLaravelDir, 'config'));
    console.log('   - config/ ✅');

    // 5. Sync database/
    copyDirRecursive(path.join(root, 'database'), path.join(serverLaravelDir, 'database'));
    console.log('   - database/ (migrations, seeders) ✅');

    // 6. Sync bootstrap/app.php
    const bootstrapSrc = path.join(root, 'bootstrap', 'app.php');
    const bootstrapDest = path.join(serverLaravelDir, 'bootstrap', 'app.php');
    if (fs.existsSync(bootstrapSrc)) {
        fs.copyFileSync(bootstrapSrc, bootstrapDest);
        console.log('   - bootstrap/app.php ✅');
    }

    // 7. Bersihkan View Cache & Route Cache di server
    const viewsCacheDir = path.join(serverLaravelDir, 'storage', 'framework', 'views');
    if (fs.existsSync(viewsCacheDir)) {
        const cachedViews = fs.readdirSync(viewsCacheDir);
        for (const file of cachedViews) {
            if (file.endsWith('.php') || file.startsWith('.')) {
                try { fs.unlinkSync(path.join(viewsCacheDir, file)); } catch (e) {}
            }
        }
        console.log('   - storage/framework/views cache cleared ✅');
    }

    const bootstrapCacheDir = path.join(serverLaravelDir, 'bootstrap', 'cache');
    if (fs.existsSync(bootstrapCacheDir)) {
        const cachedFiles = fs.readdirSync(bootstrapCacheDir);
        for (const file of cachedFiles) {
            if (file.endsWith('.php')) {
                try { fs.unlinkSync(path.join(bootstrapCacheDir, file)); } catch (e) {}
            }
        }
        console.log('   - bootstrap/cache cleared ✅');
    }

    console.log('🎉 SINKRONISASI BACKEND SELESAI OTOMATIS!\n');
} else {
    console.log('ℹ️  Build lokal: Folder backend server tidak terdeteksi (Normal saat build di laptop).');
}
