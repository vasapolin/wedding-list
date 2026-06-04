#!/usr/bin/env sh
set -e

mkdir -p /data
if [ ! -f /data/database.sqlite ]; then
    touch /data/database.sqlite
fi
chown -R www-data:www-data /data
chmod 664 /data/database.sqlite

# Persistent uploads (gift photos, site assets) live on the Fly volume so they
# survive deploys. Symlink storage/app/public -> /data/uploads, then have
# public/storage point to that via the standard storage:link target.
mkdir -p /data/uploads
chown -R www-data:www-data /data/uploads

cd /app

if [ -L /app/storage/app/public ] || [ -d /app/storage/app/public ]; then
    rm -rf /app/storage/app/public
fi
ln -sfn /data/uploads /app/storage/app/public

if [ ! -L /app/public/storage ]; then
    rm -rf /app/public/storage
    ln -sfn /app/storage/app/public /app/public/storage
fi

php artisan migrate --force --no-interaction
php artisan db:seed --force --no-interaction || true
php artisan config:cache
php artisan route:cache
php artisan view:cache

chown -R www-data:www-data /app/bootstrap/cache /app/storage

exec "$@"
