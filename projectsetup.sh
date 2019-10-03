#!/bin/bash

echo ""
echo "============= project setup ============="
echo ""
cd /vagrant/api_lumen
composer install --optimize-autoloader --no-dev
php artisan migrate --seed
# php artisan config:cache
# php artisan route:cache

echo " | installing and building vue project (it might take few minutes)"
cd /vagrant/client_vuejs
sudo npm install --no-bin-links
sudo npm install -g @vue/cli
sudo npm install -g @vue/cli-service
sudo npm install -g @vue/cli-plugin-babel
sudo npm install -g @vue/cli-plugin-eslint
sudo npm install -g vue-template-compiler
sudo yarn build