FROM php:8.3-apache

RUN docker-php-ext-install pdo_mysql \
    && a2enmod rewrite

WORKDIR /var/www/html
COPY app ./app
COPY scheme ./scheme
COPY public ./public
COPY runtime ./runtime
COPY docker/render-vhost.conf /etc/apache2/sites-available/000-default.conf
COPY docker/render-entrypoint.sh /usr/local/bin/render-entrypoint

RUN chmod +x /usr/local/bin/render-entrypoint \
    && chown -R www-data:www-data /var/www/html/runtime

EXPOSE 10000
ENTRYPOINT ["/usr/local/bin/render-entrypoint"]
