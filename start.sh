#!/bin/bash

# Optional but recommended
echo "→ Running artisan storage:link"
php artisan storage:link

echo "→ Clearing config cache"
php artisan config:clear

echo "→ Rebuilding config cache"
php artisan config:cache

# Start Apache
echo "→ Starting Apache..."
apache2-foreground
