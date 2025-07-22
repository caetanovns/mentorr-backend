#!/bin/bash

# Aguarda se o volume ainda não estiver pronto (caso aplicável)
sleep 2

# Executa as migrations
php artisan migrate --force

# Executa os seeders
php artisan db:seed --force

#
chown -R www-data:www-data storage bootstrap/cache

# Inicia o Apache em foreground
apache2-foreground
