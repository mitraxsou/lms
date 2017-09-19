#created by soumitra for iandwe.in 
#start with our base image (the foundation) - version 7.1.5
FROM php:7.1.5-apache

#install all the system dependencies and enable PHP modules 
RUN apt-get update && apt-get install -y \  
      libicu-dev \
      libpq-dev \
      libmcrypt-dev \
      git \
      zip \
      unzip \
    && rm -r /var/lib/apt/lists/* \
    && docker-php-ext-configure pdo_mysql --with-pdo-mysql=mysqlnd \
    && docker-php-ext-install \
      intl \
      mbstring \
      mcrypt \
      pcntl \
      pdo_mysql \
      pdo_pgsql \
      pgsql \
      zip \
      opcache

#install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer

#set our application folder as an environment variable
ENV APP_HOME /var/www/html
ENV PHP_INI /usr/local/etc/php/

#change uid and gid of apache to docker user uid/gid
RUN usermod -u 1000 www-data && groupmod -g 1000 www-data

#change the web_root to laravel /var/www/html/public folder
RUN sed -i -e "s/html/html\/public/g" /etc/apache2/sites-enabled/000-default.conf

# enable apache module rewrite
RUN a2enmod rewrite

#copy source files and run composer
COPY ./src $APP_HOME
COPY ./env $APP_HOME

# copying local config folder to phpconfig container
COPY ./config/phpconfig $PHP_INI

# install all PHP dependencies
RUN composer install --no-interaction

#adding zizaco to vendor
COPY ./config/vendorextra /var/www/html/vendor/

RUN php artisan cache:clear 
RUN php artisan clear-compiled

#chmod storage

RUN chmod -R 777 storage 
RUN chmod -R 777 bootstrap/cache

RUN composer dump-autoload

