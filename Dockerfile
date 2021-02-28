FROM php:8.0-alpine AS build-env

LABEL owner="Giancarlos Salas"
LABEL maintainer="giansalex@gmail.com"

ENV APP_ENV prod
WORKDIR /app

RUN apk update && apk add --no-cache \
    openssl \
    git \
    unzip && \
    curl --silent --show-error -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY . .

RUN composer install --no-interaction --no-dev --optimize-autoloader --ignore-platform-reqs && \
    composer dump-autoload --optimize --no-dev --classmap-authoritative && \
    composer dump-env prod --empty && \
    find -name "[Tt]est*" -type d -exec rm -rf {} + && \
    find -type f -name '*.md' -delete;

FROM php:8.0-alpine

ENV APP_ENV prod

EXPOSE 8000
WORKDIR /var/www/html

RUN apk update && docker-php-ext-install pcntl

COPY --from=build-env /app .

# Copy configuration
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

ENTRYPOINT ["vendor/bin/server"]
CMD ["run", "0.0.0.0:8000", "--adapter=App\\AppKernelAdapter", "--no-static-folder", "--workers=-1"]
