FROM dunglas/frankenphp:1-php8.5

RUN apt-get update && apt-get install --no-install-recommends -y \
    acl \
    file \
    gettext \
    git \
    && rm -rf /var/lib/apt/lists/*

RUN install-php-extensions \
    pdo_pgsql \
    pgsql \
    redis \
    amqp \
    sockets \
    gd \
    zip \
    intl \
    bcmath \
    pcntl \
    exif \
    xdebug

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY composer.json composer.lock ./
RUN composer install \
    --no-scripts \
    --prefer-dist

COPY . .

RUN composer dump-autoload \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

COPY Caddyfile /etc/frankenphp/Caddyfile
