#!/bin/bash
# Don't use set -e so one failed command doesn't kill the container

echo "=== Starting Abu Aneefah Islamic Academy ==="

# Generate APP_KEY if not set
if [ -z "$APP_KEY" ]; then
    export APP_KEY=$(php -r "echo 'base64:'.base64_encode(random_bytes(32));")
    echo "Generated APP_KEY"
fi

# Configure Apache to listen on the correct PORT (Render provides this)
PORT=${PORT:-80}
echo "Using PORT: $PORT"

if [ -f /etc/apache2/ports.conf ]; then
    sed -i "s/Listen 80/Listen $PORT/g" /etc/apache2/ports.conf
    sed -i "s/Listen .*$/Listen $PORT/g" /etc/apache2/ports.conf
fi

sed -i "s/*:80/*:$PORT/g" /etc/apache2/sites-available/000-default.conf
sed -i "s/Listen 80/Listen $PORT/g" /etc/apache2/sites-available/000-default.conf 2>/dev/null

# Create storage directory structure if missing
mkdir -p storage/framework/sessions
mkdir -p storage/framework/views
mkdir -p storage/framework/cache
mkdir -p storage/logs
mkdir -p bootstrap/cache

# Use SQLite if no external database configured
if [ -z "$DB_HOST" ] && [ -z "$DATABASE_URL" ]; then
    echo "No external DB configured — using SQLite"
    export DB_CONNECTION="sqlite"
    touch database/database.sqlite
    chmod 666 database/database.sqlite
fi

# Run migrations
echo "Running migrations..."
php artisan migrate --force 2>&1 || echo "WARNING: Migration failed, continuing anyway"

# Ensure permissions
echo "Setting permissions..."
chown -R www-data:www-data storage bootstrap/cache database 2>/dev/null
chmod -R 775 storage bootstrap/cache database 2>/dev/null

# Clear cached config
php artisan config:clear 2>/dev/null
php artisan route:clear 2>/dev/null
php artisan view:clear 2>/dev/null

echo "=== Starting Apache ==="
exec "$@"
