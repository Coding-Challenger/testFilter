FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql exif pcntl bcmath gd

# Xdebug
RUN pecl install xdebug
RUN docker-php-ext-enable xdebug

ADD . /var/www

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer



RUN chown -R www-data:www-data /var/www

RUN chmod u+rwx,g+rx,o+rx /var/www
RUN chown -R www-data:www-data /var/www/bootstrap/cache /var/www/storage
RUN find /var/www -type d -exec chmod u+rwx,g+rx,o+rx {} +
RUN find /var/www -type f -exec chmod u+rw,g+rw,o+r {} +

USER 1000

# Set working directory
WORKDIR /var/www
