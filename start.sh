#!/bin/bash

export PRIME_ACCESS="$PRIME_ACCESS"
export PRIME_PASSWORD="$PRIME_PASSWORD"

# Optional but recommended
echo "→ Running artisan storage:link"
php artisan storage:link

chmod -R 755 storage
chmod -R 755 public/storage

echo "→ Clearing config cache"
php artisan config:clear

echo "→ Rebuilding config cache"
php artisan config:cache

# Start Apache
echo "→ Starting Apache..."
apache2-foreground
