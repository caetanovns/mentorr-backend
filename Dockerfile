FROM php:8.2-apache

# Instalar dependências e extensões
RUN apt-get update && apt-get install -y \
    libsqlite3-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-install pdo pdo_sqlite

# Habilitar mod_rewrite
RUN a2enmod rewrite

# Definir DocumentRoot para public/
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

# Atualizar a configuração do Apache para usar public/
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/000-default.conf

# Copiar o código da aplicação
COPY . /var/www/html

# Definir diretório de trabalho
WORKDIR /var/www/html

# Instalar Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Instalar dependências Laravel
RUN composer install --no-interaction --prefer-dist

# Criar banco SQLite e corrigir permissões
RUN mkdir -p database && touch database/database.sqlite \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

EXPOSE 80

# Copia o script de entrada
COPY entrypoint.sh /usr/local/bin/entrypoint.sh

# Dá permissão de execução
RUN chmod +x /usr/local/bin/entrypoint.sh

ENTRYPOINT ["entrypoint.sh"]
