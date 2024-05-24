FROM php:7.4-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y git unzip

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy project files
COPY . /var/www

# Install Composer dependencies
RUN composer install

# Command to start the PHP built-in server
CMD php -S 0.0.0.0:8000 -t /var/www
