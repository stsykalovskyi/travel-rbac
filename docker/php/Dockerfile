FROM php:7.4-fpm-alpine

RUN adduser serhii -D -g serhii
RUN apk add git mc wget npm gcc libzip-dev zip autoconf postgresql-dev curl make nano --no-cache
RUN npm install bower -g
RUN npm install sass -g
RUN docker-php-ext-configure zip && docker-php-ext-install bcmath pdo_pgsql zip
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer
RUN mkdir -p /var/www
RUN echo '/usr/local/lib/php/extensions/no-debug-non-zts-20160303/xdebug.so' >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.idekey=PHPSTORM" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.remote_autostart=1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
WORKDIR /var/www