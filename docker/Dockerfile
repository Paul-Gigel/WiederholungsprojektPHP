FROM php:8.0.2-fpm

RUN apt-get update && apt-get install -y \
    git     \
    curl    \
    zip     \
    unzip   \
    nano
    #php-xdebug \

RUN set -ex \
    docker-php-ext-configure pdo_mysql --with-pdo-mysql=mysqlnd \
    && docker-php-ext-install pdo pdo_mysql \
    #&& docker-php-ext-install xdebug \
    #&& docker-php-ext-enable xdebug \
    && docker-php-ext-enable pdo pdo_mysql

RUN yes | pecl install xdebug \
    && echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_enable=on" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_autostart=off" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.start_with_request = yes" >> /usr/local/etc/php/conf.d/xdebug.ini
#RUN mv /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini
WORKDIR /var/www