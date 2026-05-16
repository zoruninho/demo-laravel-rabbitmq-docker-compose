FROM dunglas/frankenphp:1-php8.5

RUN apt-get update && apt-get install --no-install-recommends -y \
    acl \
    file \
    gettext \
    git \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions for Laravel + Postgres
RUN install-php-extensions \
    pdo_pgsql \
    pgsql \
    redis \
    amqp \
    gd \
    zip \
    intl \
    bcmath \
    opcache \
    pcntl \
    mbstring \
    exif

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY composer.json composer.lock ./
RUN composer install \
    --no-dev \
    --no-scripts \
    --no-autoloader \
    --prefer-dist \
    --optimize-autoloader

COPY . .

RUN composer dump-autoload --optimize \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

COPY Caddyfile /etc/caddy/Caddyfile
