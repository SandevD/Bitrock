#!/bin/bash
set -e

echo "🎉 Deployment started ..."
echo "=========================="

# Enter maintenance mode or return true
# if already is in maintenance mode
(php artisan down) || true

# Pull the latest version of the app
echo "🚚 Fetching the latest version of the app ..."
echo "=============================================="
#git reset --hard
#git clean -df
git pull origin stable

# Install composer dependencies
echo "📦️ Installing dependancies ..."
echo "==============================="
composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

# Clear the old cache
echo "🔥 Clearing cache ..."
echo "======================"
php artisan clear-compiled


# Clear the old sessions
rm -f /home/bitrock/public_html/storage/framework/sessions/*

# Recreate cache
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run database migrations
echo "🗃️ Running database migrations ..."
echo "==================================="
# php artisan migrate:fresh --seed
php artisan migrate

# Run the seeders
echo "🗃️ Running Seeders ..."
echo "==================================="


#Fix Permissions
echo "🔐 Fixing permissions ..."
echo "==========================="
find /home/bitrock/public_html -type d -print0 | xargs -0 chmod 0755
find /home/bitrock/public_html -type f -print0 | xargs -0 chmod 0644
find /home/bitrock/public_html -type f -name "*.php" | xargs chmod 640

# Exit maintenance mode
php artisan up

echo "✅ Deployment finished!"
echo "========================"