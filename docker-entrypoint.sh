#!/bin/bash
set -e

# Generate APP_KEY if not set via environment
if [ -z "$APP_KEY" ]; then
    export APP_KEY=$(php -r "echo 'base64:'.base64_encode(random_bytes(32));")
    echo "Generated APP_KEY for this session"
fi

# Configure Apache to listen on Render's PORT
PORT=${PORT:-80}
sed -i "s/Listen 80/Listen $PORT/" /etc/apache2/ports.conf
sed -i "s/*:80/*:$PORT/" /etc/apache2/sites-available/000-default.conf

# Run database migrations
php artisan migrate --force

# Ensure storage permissions at runtime
chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache

# Start Apache
exec "$@"
