FROM php:8.1-fpm

RUN apt-get update \
    && apt-get install -y libpq-dev git \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql

WORKDIR /var/www/html
# make composer available when installing packages inside the container
COPY --from=composer /usr/bin/composer /usr/bin/composer
CMD ["php-fpm", "-F"]