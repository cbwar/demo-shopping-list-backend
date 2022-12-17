FROM php:8.0-fpm

RUN apt-get update && \
    apt-get install -y wget git unzip tzdata supervisor && \
    apt-get clean && rm -rf /var/lib/apt/lists/*

RUN apt-get update && \
    pecl install redis-5.3.6 && docker-php-ext-enable redis && \
    pecl install xdebug && docker-php-ext-enable xdebug && \
    apt-get install -y libcurl4-openssl-dev libicu-dev && \
    docker-php-ext-configure intl && docker-php-ext-install intl && \
    docker-php-ext-install pdo_mysql && \
    apt-get clean && rm -rf /var/lib/apt/lists/*

RUN ln -fs /usr/share/zoneinfo/Europe/Paris /etc/localtime && \
    dpkg-reconfigure -f noninteractive tzdata

# Install symfony cli
RUN curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.deb.sh' | bash && \
    apt install -y symfony-cli && \
    rm -rf /var/lib/apt/lists/*

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php && \
    php -r "unlink('composer-setup.php');" && \
    mv /var/www/html/composer.phar /usr/local/bin/composer && \
    chmod +x /usr/local/bin/composer

ARG UID=1000
ARG GID=1000

RUN addgroup --gid ${GID} dev && \
    adduser --home /home/dev --uid ${UID} --gid ${GID} dev

COPY php.ini /etc/php/8.0/fpm/conf.d/30-custom.ini
COPY php.ini /etc/php/8.0/cli/conf.d/30-custom.ini

COPY supervisord.conf /etc/supervisor/supervisord.conf
CMD ["/usr/bin/supervisord"]

VOLUME /home/dev
USER dev
WORKDIR /sources

EXPOSE 8000
