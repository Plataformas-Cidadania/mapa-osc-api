FROM php:7.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y git

RUN  apt-get install -y libzip-dev \
     && docker-php-ext-install zip

RUN  apt-get install -y \
    libpq-dev \
    libmcrypt-dev \
    openssl \
    libxml2-dev \
    libpng-dev \ 
    libcurl4-openssl-dev \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN apt-get install -y libpq-dev \ 
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql \
    && docker-php-ext-install mbstring \
    && docker-php-ext-install xml \
    && docker-php-ext-install gd \
    && docker-php-ext-install bcmath \
    && docker-php-ext-install json \
    && docker-php-ext-install mbstring \
    && docker-php-ext-install curl

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
CMD ./wait-for-it.sh db_mapa:5432 -- ./start.sh

EXPOSE 8000
