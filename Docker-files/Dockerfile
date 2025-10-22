# Use official PHP 8.3 with Apache as base image
FROM php:8.3-apache

# Set working directory inside container
WORKDIR /var/www/html

# Install required system packages and PHP extensions for Laravel
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Enable Apache mod_rewrite (for Laravel routing)
RUN a2enmod rewrite

# Copy composer from official image to save install time
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy project files into container
COPY . /var/www/html

# Set proper permissions for Laravel
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Install dependencies
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Copy environment file if available
COPY .env.example .env

# Generate Laravel app key
RUN php artisan key:generate

# Expose port 80 for Apache
EXPOSE 80

# Start Apache in the foreground
CMD ["apache2-foreground"]
