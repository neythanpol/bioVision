FROM php:8.3-fpm-alpine

# Instalar dependencias
RUN apk add --no-cache \
    git \
    curl \
    libpq-dev \
    libzip-dev \
    postgresql-client \
    && docker-php-ext-install pdo pdo_pgsql zip

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html
COPY . .

# Instalar dependencias de Symfony (sin dev)
RUN git config --global --add safe.directory /var/www/html && \
    composer install --no-dev --optimize-autoloader --ignore-platform-reqs