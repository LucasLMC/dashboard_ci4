FROM php:8.1.9-apache
RUN echo "ServerName 127.0.0.1" >> /etc/apache2/apache2.conf
RUN apt-get clean
RUN apt-get update && apt-get install -y \
    zlib1g-dev libicu-dev g++ \
    libjpeg62-turbo-dev \
    libzip-dev \
    libpng-dev \
    libwebp-dev \
    libfreetype6-dev \
    libxml2-dev \
    git \
    zip \
    unzip \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-configure gd --with-webp=/usr/include/webp --with-jpeg=/usr/include --with-freetype=/usr/include/freetype2/ \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install -j$(nproc) zip \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl \
    && docker-php-ext-install mysqli


RUN apt-get -y install --fix-missing curl
RUN apt-get -y install --fix-missing git
RUN apt-get -y install --fix-missing zip unzip


RUN apt-get install --fix-missing -y libpq-dev
RUN apt-get install --no-install-recommends -y libpq-dev
RUN apt-get install -y libxml2-dev libbz2-dev zlib1g-dev

RUN apt-get install --fix-missing -y libsqlite3-dev \
    libsqlite3-0 \
    exif \
    ftp \
    ntp \
    gdal-bin

# ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
# RUN chmod +x /usr/local/bin/install-php-extensions && \
#     install-php-extensions \
#     curl fileinfo gd mbstring mysqli intl openssl pdo_mysql
# RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli intl
# 2. set up document root for apache
COPY docker/apache/000-default.conf /etc/apache2/sites-available/000-default.conf

# 3. mod_rewrite for URL rewrite and mod_headers for .htaccess extra headers like Access-Control-Allow-Origin-
RUN a2enmod rewrite headers

# 4. start with base php config, then add extensions

# 5. Composer
RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer
RUN chmod +x /usr/local/bin/composer
RUN composer self-update

COPY ./ /var/www/html/
# 6. we need a user with the same UID/GID with host user
# so when we execute CLI commands, all the host file's ownership remains intact
# otherwise command from inside container will create root-owned files and directories
ARG uid
RUN useradd -G www-data,root -u $uid -d /home/devuser devuser
RUN composer install
# RUN composer require myth/auth
RUN mkdir -p /home/devuser/.composer && \
    chown -R devuser:devuser /home/devuser


# COPY docker/mysql/php.ini "$PHP_INI_DIR/php.ini"
RUN echo "mysqli.default_socket =/tmp/mysql.sock" >> "$PHP_INI_DIR/php.ini"
# RUN echo "extension=mysqli" >> "$PHP_INI_DIR/php.ini"
