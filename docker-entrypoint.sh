#!/bin/bash

echo "=== Starting Abu Aneefah Islamic Academy ==="

if [ -z "$APP_KEY" ]; then
    export APP_KEY=$(php -r "echo 'base64:'.base64_encode(random_bytes(32));")
    echo "Generated APP_KEY"
fi

PORT=${PORT:-80}
echo "Using PORT: $PORT"

echo "=== MySQL SSL Diagnostic ==="

CA_FILE="${MYSQL_ATTR_SSL_CA:-/etc/secrets/ca.pem}"

if [ -r "$CA_FILE" ]; then
    echo "CA certificate exists and is readable."
else
    echo "ERROR: CA certificate missing or unreadable."
fi

echo "PDO MySQL extension: $(php -r "echo extension_loaded('pdo_mysql') ? 'AVAILABLE' : 'MISSING';")"

if [ -n "$DB_HOST" ] && [ -n "$DB_USERNAME" ] && [ -n "$DB_PASSWORD" ]; then
    echo "Testing direct Aiven PDO connection..."

    php -r '
    try {
        $ca = getenv("MYSQL_ATTR_SSL_CA") ?: "/etc/secrets/ca.pem";

        $pdo = new PDO(
            "mysql:host=" . getenv("DB_HOST") .
            ";port=" . getenv("DB_PORT") .
            ";dbname=" . getenv("DB_DATABASE"),
            getenv("DB_USERNAME"),
            getenv("DB_PASSWORD"),
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::MYSQL_ATTR_SSL_CA => $ca,
                PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => true,
                PDO::ATTR_TIMEOUT => 10
            ]
        );

        echo "SUCCESS: Direct PDO connection established.\n";
        echo "Server version: " . $pdo->getAttribute(PDO::ATTR_SERVER_VERSION) . "\n";
    } catch (Throwable $e) {
        echo "FAILED: " . get_class($e) . "\n";
        echo "Error: " . $e->getMessage() . "\n";
        exit(1);
    }
    '
else
    echo "ERROR: Required database environment variables are missing."
fi

echo "=== End MySQL SSL Diagnostic ==="

if [ -f /etc/apache2/ports.conf ]; then
    sed -i "s/Listen 80/Listen $PORT/g" /etc/apache2/ports.conf
    sed -i "s/Listen .*$/Listen $PORT/g" /etc/apache2/ports.conf
fi

sed -i "s/*:80/*:$PORT/g" /etc/apache2/sites-available/000-default.conf
sed -i "s/Listen 80/Listen $PORT/g" /etc/apache2/sites-available/000-default.conf 2>/dev/null

mkdir -p storage/framework/sessions
mkdir -p storage/framework/views
mkdir -p storage/framework/cache
mkdir -p storage/logs
mkdir -p bootstrap/cache

if [ -z "$DB_HOST" ] && [ -z "$DATABASE_URL" ]; then
    echo "No external DB configured - using SQLite"
    export DB_CONNECTION="sqlite"
    touch database/database.sqlite
    chmod 666 database/database.sqlite
fi

echo "Running migrations..."
php artisan migrate --force 2>&1 || echo "WARNING: Migration failed, continuing anyway"

php artisan config:clear 2>/dev/null
php artisan route:clear 2>/dev/null
php artisan view:clear 2>/dev/null

echo "=== Laravel Database Connection Test ==="

php artisan tinker --execute='
try {
    $config = config("database.connections.mysql");

    echo "Default connection: " . config("database.default") . PHP_EOL;
    echo "MySQL host configured: " . (!empty($config["host"]) ? "YES" : "NO") . PHP_EOL;
    echo "MySQL port configured: " . (!empty($config["port"]) ? "YES" : "NO") . PHP_EOL;
    echo "SSL CA configured: " . (!empty($config["options"][PDO::MYSQL_ATTR_SSL_CA]) ? "YES" : "NO") . PHP_EOL;

    DB::connection("mysql")->getPdo();

    echo "SUCCESS: Laravel connected to MySQL." . PHP_EOL;
} catch (Throwable $e) {
    echo "FAILED: Laravel database connection." . PHP_EOL;
    echo get_class($e) . PHP_EOL;
    echo $e->getMessage() . PHP_EOL;
}
'

echo "=== End Laravel Database Connection Test ==="

echo "=== Preparing MySQL SSL Certificate for Apache ==="

if [ -r "$CA_FILE" ]; then
    cp "$CA_FILE" /tmp/aiven-ca.pem
    chmod 644 /tmp/aiven-ca.pem

    export MYSQL_ATTR_SSL_CA=/tmp/aiven-ca.pem

    echo "SSL certificate copied successfully."
    echo "Apache will use: $MYSQL_ATTR_SSL_CA"
else
    echo "ERROR: Original SSL certificate is missing or unreadable."
    exit 1
fi
chown -R www-data:www-data storage bootstrap/cache database 2>/dev/null
chmod -R 775 storage bootstrap/cache database 2>/dev/null

echo "=== Starting Apache ==="
exec "$@"
