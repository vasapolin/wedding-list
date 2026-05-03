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

# ---------- Stage 3: Runtime (FrankenPHP) ----------
FROM dunglas/frankenphp:1-php8.2

RUN install-php-extensions pdo_sqlite opcache

COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

WORKDIR /app

COPY . /app
COPY --from=composer-deps /app/vendor /app/vendor
COPY --from=node-build /app/public/build /app/public/build

RUN composer dump-autoload --optimize --no-dev --classmap-authoritative \
    && chown -R www-data:www-data /app/storage /app/bootstrap/cache

ENV SERVER_NAME=":8080"
EXPOSE 8080

COPY docker/entrypoint.sh /docker-entrypoint.sh
RUN chmod +x /docker-entrypoint.sh

ENTRYPOINT ["/docker-entrypoint.sh"]
CMD ["frankenphp", "run", "--config", "/etc/caddy/Caddyfile"]
