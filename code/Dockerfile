FROM php:5.6-fpm

MAINTAINER rafaelcalleja@gmail.org

ENV DEBIAN_FRONTEND noninteractive

RUN apt-get update && apt-get install -y \
    git \
    zip \
    curl \
    php5-cli \
    php5-json \
    php5-intl \
    php5-fpm \
    php5-mysql \
    mysql-client

RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer

ENV DOKIFY_CHALLENGE_VERSION 1.0

ADD app /var/www/html/app
ADD src /var/www/html/src
ADD web /var/www/html/web
ADD bin /var/www/html/bin

COPY app/config/parameters.yml.dist /var/www/html/app/config/parameters.yml
COPY composer.json /var/www/html
COPY composer.lock /var/www/html

RUN chown -Rv www-data:www-data /var/www/

WORKDIR /var/www/html
RUN composer install -n
RUN rm /var/www/html/app/cache/* -rf && \
    rm /var/www/html/app/logs/* -rf && \
    rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install mbstring mysql pdo_mysql

COPY dockerfiles/php.ini /usr/local/etc/php/php.ini
COPY dockerfiles/docker-entrypoint.sh /entrypoint.sh
COPY dockerfiles/mysql-setup.sh /mysql-setup.sh
COPY dockerfiles/symfony-bootstrap.sh /symfony-bootstrap.sh
COPY dockerfiles/triggers.sql /triggers.sql
VOLUME /var/www/html

RUN setfacl -R -m u:www-data:rwX -m u:root:rwX app/cache/ && \
    setfacl -dR -m u:www-data:rwX -m u:root:rwX app/cache/ && \
    setfacl -R -m u:www-data:rwX -m u:root:rwX app/logs/ && \
    setfacl -dR -m u:www-data:rwX -m u:root:rwX app/logs/

EXPOSE 9000
ENTRYPOINT ["/entrypoint.sh"]
CMD ["php-fpm"]
#CMD ["/bin/bash"]
