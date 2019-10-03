#!/bin/bash

# stop nginx

# add our config file to nginx and enable the site
sudo cp /vagrant/configfiles/nginxdualserver.conf /etc/nginx/sites-available/
sudo ln -s /etc/nginx/sites-available/nginxdualserver.conf /etc/nginx/sites-enabled/

sudo systemctl restart nginx