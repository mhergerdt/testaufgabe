FROM php:7.3-alpine

RUN apk --update --no-cache add unzip git shadow \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && usermod -u 1000 www-data \
    && apk del --purge shadow

COPY . /var/www/project

RUN chown -R www-data:www-data /var/www

USER www-data
WORKDIR /var/www/project

RUN composer install --optimize-autoloader

CMD bin/console
