#!/bin/sh
set -e
cd /var/www/html

# jalankan migrasi (idempotent) dan isi data awal jika tabel masih kosong
php artisan migrate --force
if [ "${RUN_SEEDER:-true}" = "true" ]; then
    php artisan db:seed --force
fi

# optimasi untuk production
php artisan config:cache
php artisan route:cache
php artisan view:cache

chown -R www-data:www-data storage bootstrap/cache
exec "$@"
