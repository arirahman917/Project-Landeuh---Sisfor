#!/bin/bash
set -e

# Fix Apache MPM conflict at runtime
rm -f /etc/apache2/mods-enabled/mpm_event.load /etc/apache2/mods-enabled/mpm_event.conf
rm -f /etc/apache2/mods-enabled/mpm_worker.load /etc/apache2/mods-enabled/mpm_worker.conf
ln -sf /etc/apache2/mods-available/mpm_prefork.load /etc/apache2/mods-enabled/mpm_prefork.load
ln -sf /etc/apache2/mods-available/mpm_prefork.conf /etc/apache2/mods-enabled/mpm_prefork.conf

# Ensure .env file exists (Laravel requires it even if env vars come from the OS)
if [ ! -f /var/www/html/.env ]; then
    touch /var/www/html/.env
fi

# Ensure storage directories exist and are writable
mkdir -p /var/www/html/storage/framework/sessions
mkdir -p /var/www/html/storage/framework/views
mkdir -p /var/www/html/storage/framework/cache
mkdir -p /var/www/html/storage/logs
chown -R www-data:www-data /var/www/html/storage
chmod -R 775 /var/www/html/storage

# Clear and rebuild Laravel caches for production
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Run Laravel migrations
php artisan migrate --force

# Start queue worker in background to process emails without freezing the UI
php artisan queue:work --tries=3 --timeout=90 &

# Start Apache in foreground
exec apache2-foreground
