#!/usr/bin/env sh
set -e

mkdir -p /data
if [ ! -f /data/database.sqlite ]; then
    touch /data/database.sqlite
fi
chown -R www-data:www-data /data
chmod 664 /data/database.sqlite

cd /app

php artisan migrate --force --no-interaction
php artisan config:cache
php artisan route:cache
php artisan view:cache

chown -R www-data:www-data /app/bootstrap/cache

exec "$@"
