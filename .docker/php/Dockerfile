ARG PHP_VERSION=8.4
FROM php:${PHP_VERSION}-fpm-bookworm

ARG UID=1000
ARG GID=1000
ARG NODE_MAJOR=22

ENV COMPOSER_ALLOW_SUPERUSER=1 \
    COMPOSER_HOME=/tmp/composer \
    PATH="/tmp/composer/vendor/bin:${PATH}"

# Laravel 13 requires PHP >= 8.3 and its standard PHP extensions. Extra
# database, image, queue, and test extensions cover common Laravel projects.
RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        ca-certificates curl git gnupg default-mysql-client unzip \
        libfreetype6-dev libicu-dev libjpeg62-turbo-dev libonig-dev \
        libpng-dev libpq-dev libzip-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j"$(nproc)" \
        bcmath exif gd intl mbstring mysqli opcache pcntl pdo_mysql pdo_pgsql zip \
    && pecl install pcov \
    && docker-php-ext-enable pcov \
    && curl -fsSL "https://deb.nodesource.com/setup_${NODE_MAJOR}.x" | bash - \
    && apt-get install -y --no-install-recommends nodejs \
    && corepack enable \
    && apt-get purge -y --auto-remove gnupg \
    && rm -rf /var/lib/apt/lists/* /tmp/pear

COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer
COPY php.ini /usr/local/etc/php/conf.d/99-laravel.ini
COPY docker.conf /usr/local/etc/php-fpm.d/zz-docker.conf

RUN groupmod --non-unique --gid "${GID}" www-data \
    && usermod --non-unique --uid "${UID}" --gid "${GID}" www-data \
    && mkdir -p /var/www /tmp/composer \
    && chown -R www-data:www-data /var/www /tmp/composer

WORKDIR /var/www
USER www-data

EXPOSE 9000 5173 8000

CMD ["php-fpm"]
