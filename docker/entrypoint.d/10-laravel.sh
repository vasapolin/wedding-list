#!/usr/bin/env bash
set -euo pipefail

# Ensure the SQLite file exists on the persistent volume.
mkdir -p /data
if [ ! -f /data/database.sqlite ]; then
    touch /data/database.sqlite
fi
chown www-data:www-data /data /data/database.sqlite
chmod 664 /data/database.sqlite

# Warm Laravel caches with runtime env (Fly secrets + [env]) loaded.
cd /var/www/html
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Make sure the cache files are owned by the runtime user.
chown -R www-data:www-data /var/www/html/bootstrap/cache
