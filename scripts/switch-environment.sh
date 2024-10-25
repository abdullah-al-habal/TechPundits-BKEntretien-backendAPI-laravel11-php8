#!/bin/bash

# Define variables
BLUE_DIR="/var/www/blue"
GREEN_DIR="/var/www/green"
LIVE_SYMLINK="/var/www/live"

# Function to check if a directory exists
check_directory() {
    if [ ! -d "$1" ]; then
        echo "Error: Directory $1 does not exist."
        exit 1
    fi
}

# Check if directories exist
check_directory "$BLUE_DIR"
check_directory "$GREEN_DIR"

# Determine current live environment
if [ "$(readlink -f $LIVE_SYMLINK)" == "$BLUE_DIR" ]; then
    NEW_LIVE="$GREEN_DIR"
    OLD_LIVE="$BLUE_DIR"
else
    NEW_LIVE="$BLUE_DIR"
    OLD_LIVE="$GREEN_DIR"
fi

# Switch symlink
if ln -nsf "$NEW_LIVE" "$LIVE_SYMLINK"; then
    echo "Switched to $(basename $NEW_LIVE)"
else
    echo "Error: Failed to switch symlink."
    exit 1
fi

# Reload web server
if sudo systemctl reload nginx; then
    echo "Nginx reloaded successfully."
else
    echo "Error: Failed to reload Nginx."
    exit 1
fi

# Change to new live directory
cd "$NEW_LIVE" || exit 1

# Run database migrations
if php artisan migrate --force; then
    echo "Database migrations completed."
else
    echo "Error: Database migrations failed."
    exit 1
fi

# Clear caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Warm up cache
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "Deployment complete"