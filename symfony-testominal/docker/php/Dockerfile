FROM php:8.1-fpm

RUN apt-get update \
    && apt-get install -y libpq-dev git \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql

COPY --from=composer /usr/bin/composer /usr/bin/composer
COPY ./docker/php/entrypoint.sh /entrypoint.sh
COPY ./wait-for-it.sh /wait-for-it.sh
RUN chmod +x /entrypoint.sh
RUN chmod +x /wait-for-it.sh
ENTRYPOINT ["/entrypoint.sh"]