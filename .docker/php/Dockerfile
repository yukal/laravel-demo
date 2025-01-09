FROM php:8.3-fpm-alpine

RUN apk update \
 && apk upgrade \

 && adduser -h /var/cache/nginx -g nginx -s /sbin/nologin -D -H -u 101 nginx \
 && addgroup nginx www-data \

 && apk add --no-cache \
    libpq-dev \
    libzip-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \

 && docker-php-ext-configure zip \
 && docker-php-ext-configure pdo_pgsql --with-pdo-pgsql=/usr/include/ \
 && docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ \
 && docker-php-ext-install -j$(nproc) gd pdo pgsql pdo_pgsql \
 && docker-php-ext-enable gd pgsql pdo pdo_pgsql \

 && rm -vrf /var/cache/apk/*


USER www-data

WORKDIR /var/www/html

EXPOSE 9000
CMD ["php-fpm"]
