FROM php:8.3-fpm-alpine

ARG UID=1000
ENV USERNAME=developer

# COPY --chown=www-data:www-data --chmod=644 composer.json composer.lock .

RUN apk update \
 && apk upgrade \
 \
 && adduser \
    --home /home/${USERNAME} \
    --gecos ${USERNAME} \
    --shell /bin/ash \
    --disabled-password \
    --uid ${UID} \
    ${USERNAME} www-data \
 \
 && adduser \
    --home /var/cache/nginx \
    --gecos nginx \
    --shell /sbin/nologin \
    --disabled-password \
    --no-create-home \
    --uid 101 \
    nginx \
 \
 && addgroup ${USERNAME} www-data \
 && addgroup nginx www-data \
 \
 && mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini" \
 \
 && wget -O /usr/local/bin/composer https://distfiles.alpinelinux.org/distfiles/edge/composer-2.8.4.phar \
 && chmod +x /usr/local/bin/composer \
 \
 && apk add --no-cache \
    libpq-dev \
    libzip-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    \
    findutils-locate \
    npm \
    mc \
 && apk add --update linux-headers \
 && apk --no-cache add pcre-dev ${PHPIZE_DEPS} \
 && pecl install xdebug-3.4.1 \
 \
 && docker-php-ext-configure zip --with-zip=/usr/local/include/php \
 && docker-php-ext-configure pdo_pgsql --with-pdo-pgsql=/usr/local/include/php \
 && docker-php-ext-configure gd --with-freetype=/usr/local/include/php --with-jpeg=/usr/local/include/php \
 && docker-php-ext-install -j$(nproc) gd pgsql pdo_pgsql zip \
 && docker-php-ext-enable gd pgsql pdo_pgsql xdebug \
 \
 && apk del pcre-dev ${PHPIZE_DEPS} \
 && rm -vrf /var/cache/apk/* \
 && updatedb

USER ${USERNAME}

EXPOSE 9000
CMD ["php-fpm"]
