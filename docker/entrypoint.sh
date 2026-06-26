#!/bin/bash
# =============================================================================
# Entrypoint / startup script for College Management Portal on Render
# =============================================================================
set -e

echo "======================================================"
echo " College Management Portal — Container Startup"
echo "======================================================"

# -----------------------------------------------------------------------------
# 1. Verify required environment variables
# -----------------------------------------------------------------------------
: "${APP_KEY:?ERROR: APP_KEY environment variable is not set. Generate one with: php -r \"echo 'base64:'.base64_encode(random_bytes(32));\"}"
: "${DB_HOST:?ERROR: DB_HOST environment variable is not set.}"
: "${DB_DATABASE:?ERROR: DB_DATABASE environment variable is not set.}"
: "${DB_USERNAME:?ERROR: DB_USERNAME environment variable is not set.}"
: "${DB_PASSWORD:?ERROR: DB_PASSWORD environment variable is not set.}"

echo "[✓] Required environment variables present."

# -----------------------------------------------------------------------------
# 2. Create .env from environment variables (no .env file in the image)
#    Laravel reads from the actual environment — no .env file is needed
#    when APP_KEY etc. are injected by Render. But we create a minimal one
#    as a fallback for artisan commands inside the container.
# -----------------------------------------------------------------------------
if [ ! -f .env ]; then
    echo "[→] Writing .env from environment variables..."
    cat > .env <<EOF
APP_NAME="${APP_NAME:-College Management Portal}"
APP_ENV="${APP_ENV:-production}"
APP_KEY="${APP_KEY}"
APP_DEBUG="${APP_DEBUG:-false}"
APP_URL="${APP_URL:-http://localhost}"

LOG_CHANNEL="${LOG_CHANNEL:-stack}"
LOG_STACK="${LOG_STACK:-stderr}"
LOG_LEVEL="${LOG_LEVEL:-error}"

DB_CONNECTION="${DB_CONNECTION:-pgsql}"
DB_HOST="${DB_HOST}"
DB_PORT="${DB_PORT:-5432}"
DB_DATABASE="${DB_DATABASE}"
DB_USERNAME="${DB_USERNAME}"
DB_PASSWORD="${DB_PASSWORD}"

SESSION_DRIVER="${SESSION_DRIVER:-database}"
SESSION_LIFETIME="${SESSION_LIFETIME:-120}"

CACHE_STORE="${CACHE_STORE:-database}"
QUEUE_CONNECTION="${QUEUE_CONNECTION:-database}"

BROADCAST_CONNECTION="${BROADCAST_CONNECTION:-log}"
FILESYSTEM_DISK="${FILESYSTEM_DISK:-local}"
EOF
    echo "[✓] .env written."
else
    echo "[✓] .env already exists."
fi

# -----------------------------------------------------------------------------
# 3. Fix permissions (important on Render persistent-disk mounts)
# -----------------------------------------------------------------------------
echo "[→] Setting storage & bootstrap/cache permissions..."
mkdir -p \
    storage/app/public \
    storage/framework/cache/data \
    storage/framework/sessions \
    storage/framework/testing \
    storage/framework/views \
    storage/logs \
    bootstrap/cache

chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache
echo "[✓] Permissions set."

# -----------------------------------------------------------------------------
# 4. Wait for MySQL to be ready
# -----------------------------------------------------------------------------
echo "[→] Waiting for database at ${DB_HOST}:${DB_PORT:-5432}..."
MAX_TRIES=30
COUNT=0
until pg_isready -h "${DB_HOST}" -p "${DB_PORT:-5432}" -U "${DB_USERNAME}" -d "${DB_DATABASE}" -q; do
    COUNT=$((COUNT + 1))
    if [ "$COUNT" -ge "$MAX_TRIES" ]; then
        echo "[!] Database not reachable after ${MAX_TRIES} attempts. Continuing anyway..."
        break
    fi
    echo "    Attempt ${COUNT}/${MAX_TRIES} — retrying in 3s..."
    sleep 3
done
echo "[✓] Database connection confirmed (or timed out — proceeding)."

# -----------------------------------------------------------------------------
# 5. Create the storage symlink (idempotent — only if not already linked)
# -----------------------------------------------------------------------------
if [ ! -L public/storage ]; then
    echo "[→] Creating storage symlink..."
    php artisan storage:link --no-interaction || true
    echo "[✓] Storage symlink created."
else
    echo "[✓] Storage symlink already exists."
fi

# -----------------------------------------------------------------------------
# 6. Run migrations (only if RUN_MIGRATIONS=true is explicitly set)
# -----------------------------------------------------------------------------
if [ "${RUN_MIGRATIONS}" = "true" ]; then
    echo "[→] Running database migrations..."
    php artisan migrate --force --no-interaction
    echo "[✓] Migrations complete."
else
    echo "[!] Skipping migrations (set RUN_MIGRATIONS=true to enable)."
fi

# -----------------------------------------------------------------------------
# 7. Cache bootstrapping (speeds up production significantly)
# -----------------------------------------------------------------------------
echo "[→] Caching configuration..."
php artisan config:cache --no-interaction
echo "[✓] Config cached."

echo "[→] Caching routes..."
php artisan route:cache --no-interaction
echo "[✓] Routes cached."

echo "[→] Caching views..."
php artisan view:cache --no-interaction
echo "[✓] Views cached."

echo "[→] Caching events..."
php artisan event:cache --no-interaction || true
echo "[✓] Events cached."

# -----------------------------------------------------------------------------
# 8. Start services via Supervisor (Nginx + PHP-FPM)
# -----------------------------------------------------------------------------
echo "======================================================"
echo " Startup complete — launching Nginx + PHP-FPM"
echo "======================================================"
exec /usr/bin/supervisord -c /etc/supervisord.conf
