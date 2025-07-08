#!/bin/bash

# Aguarda se o volume ainda não estiver pronto (caso aplicável)
sleep 2

# Gera chave da aplicação se ainda não existir
if [ ! -f /var/www/html/.env ]; then
  echo ".env não encontrado, você precisa copiar um antes do build"
else
  php artisan key:generate --force
fi

# Executa as migrations
php artisan migrate --force

# Executa os seeders
php artisan db:seed --force

#
chown -R www-data:www-data storage bootstrap/cache

# Inicia o Apache em foreground
apache2-foreground
