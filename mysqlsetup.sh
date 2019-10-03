#!/bin/bash

mysql -u root -psecret -e "FLUSH PRIVILEGES"

# add the project user
mysql -u root -psecret -e "CREATE USER 'humansix'@'localhost' identified by 'humansix'"
mysql -u root -psecret -e "CREATE DATABASE humansix"
mysql -u root -psecret -e "GRANT ALL PRIVILEGES ON humansix.* TO 'humansix'@'localhost'"
mysql -u root -psecret -e "GRANT ALL PRIVILEGES ON information_schema.tables TO 'humansix'@'localhost'"

# apply privileges
mysql -u root -psecret -e "FLUSH PRIVILEGES"