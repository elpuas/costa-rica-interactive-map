#!/bin/bash

# Add Local PHP to PATH
export PATH="/Applications/Local.app/Contents/Resources/extraResources/bin:$PATH"

# Verify PHP is available
php -v

# Run composer commands
composer install
composer run-script phpcs
