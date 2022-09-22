FROM php:8.1-fpm

RUN apt-get update \
    && apt-get install -y libpq-dev git \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql

WORKDIR /var/www/html
# make composer available when installing packages inside the container
COPY --from=composer /usr/bin/composer /usr/bin/composer
COPY ./docker/php/entrypoint.sh ./docker/php/entrypoint.sh
COPY ./wait-for-it.sh ./
RUN chmod +x ./docker/php/entrypoint.sh ./wait-for-it.sh
ENTRYPOINT ["./docker/php/entrypoint.sh"]