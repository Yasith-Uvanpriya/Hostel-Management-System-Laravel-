# --------------------------
# 1️⃣ Base image
# --------------------------
FROM php:8.3-apache

# Set working directory
WORKDIR /var/www/html

# --------------------------
# 2️⃣ Install required system packages and PHP extensions
# --------------------------
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip \
    && a2enmod rewrite

# --------------------------
# 3️⃣ Copy Composer from official image
# --------------------------
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# --------------------------
# 4️⃣ Copy project files
# --------------------------
COPY . /var/www/html

# --------------------------
# 5️⃣ Handle environment file (.env)
# --------------------------
# If .env.example exists → copy it, else create a default .env file
RUN if [ -f .env.example ]; then \
      cp .env.example .env; \
    else \
      echo "APP_NAME=Laravel" > .env && \
      echo "APP_ENV=local" >> .env && \
      echo "APP_KEY=" >> .env && \
      echo "APP_DEBUG=true" >> .env && \
      echo "APP_URL=http://localhost" >> .env && \
      echo "DB_CONNECTION=mysql" >> .env && \
      echo "DB_HOST=mysql" >> .env && \
      echo "DB_PORT=3306" >> .env && \
      echo "DB_DATABASE=hostel_db" >> .env && \
      echo "DB_USERNAME=root" >> .env && \
      echo "DB_PASSWORD=root" >> .env; \
    fi

# --------------------------
# 6️⃣ Install PHP dependencies via Composer
# --------------------------
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# --------------------------
# 7️⃣ Generate app key and clear caches
# --------------------------
RUN php artisan key:generate || true && \
    php artisan config:clear && \
    php artisan cache:clear && \
    php artisan route:clear

# --------------------------
# 8️⃣ Fix permissions for Laravel storage & cache
# --------------------------
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# --------------------------
# 9️⃣ Expose port and start Apache
# --------------------------
EXPOSE 80
CMD ["apache2-foreground"]
