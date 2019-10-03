#!/bin/bash

echo ""
echo "============= project setup ============="
echo ""
cd /vagrant/api_lumen
composer install --optimize-autoloader --no-dev
php artisan migrate --seed
# php artisan config:cache
# php artisan route:cache

cd /vagrant/client_vuejs
npm install
yarn build