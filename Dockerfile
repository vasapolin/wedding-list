# syntax=docker/dockerfile:1

# ---------- Stage 1: PHP dependencies ----------
FROM composer:2 AS composer-deps
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install \
    --no-dev \
    --no-scripts \
    --no-autoloader \
    --prefer-dist \
    --no-interaction \
    --no-progress

# ---------- Stage 2: Frontend assets ----------
FROM node:22-alpine AS node-build
WORKDIR /app
COPY package.json package-lock.json vite.config.js ./
RUN npm ci --no-audit --no-fund
COPY resources ./resources
COPY public ./public
RUN npm run build

# ---------- Stage 3: Runtime ----------
FROM serversideup/php:8.2-fpm-nginx

USER root

WORKDIR /var/www/html

COPY --chown=www-data:www-data . /var/www/html
COPY --chown=www-data:www-data --from=composer-deps /app/vendor /var/www/html/vendor
COPY --chown=www-data:www-data --from=node-build /app/public/build /var/www/html/public/build

RUN composer dump-autoload --optimize --no-dev --classmap-authoritative \
    && chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/vendor \
    && chmod -R ug+rwX /var/www/html/storage /var/www/html/bootstrap/cache

COPY docker/entrypoint.d/10-laravel.sh /etc/entrypoint.d/10-laravel.sh
RUN chmod +x /etc/entrypoint.d/10-laravel.sh

USER www-data
