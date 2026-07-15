#!/bin/sh
set -eu

cd /var/www/html
mkdir -p runtime images uploads

if [ ! -f runtime/connection.php ]; then
  cp includes/connection.php runtime/connection.php
fi

rm -f includes/connection.php
ln -s ../runtime/connection.php includes/connection.php

if [ ! -L api.php ]; then
  if [ -f api.php ] && [ ! -f runtime/api.php ]; then
    cp api.php runtime/api.php
  fi
  rm -f api.php
  ln -s runtime/api.php api.php
fi

chown -R www-data:www-data runtime images uploads

exec docker-php-entrypoint "$@"

