#!/bin/bash
set -e

echo "Caching configuration..."
php /var/www/artisan config:cache

echo "Caching routes..."
php /var/www/artisan route:cache

echo "Caching views..."
php /var/www/artisan view:cache

echo "Creating storage link..."
php /var/www/artisan storage:link --force 2>/dev/null || true

echo "Waiting for database connection..."
MAX_RETRIES=30
RETRY_INTERVAL=2
RETRIES=0

until php /var/www/artisan db:show > /dev/null 2>&1; do
    RETRIES=$((RETRIES + 1))
    if [ $RETRIES -ge $MAX_RETRIES ]; then
        echo "ERROR: Could not connect to database after ${MAX_RETRIES} attempts. Starting without migration."
        break
    fi
    echo "Database not ready, retrying in ${RETRY_INTERVAL}s... (${RETRIES}/${MAX_RETRIES})"
    sleep $RETRY_INTERVAL
done

if [ $RETRIES -lt $MAX_RETRIES ]; then
    echo "Running database migrations..."
    php /var/www/artisan migrate --force
fi

echo "Starting supervisord..."
exec /usr/bin/supervisord -c /etc/supervisord.conf
