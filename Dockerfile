# --------------------------
# 1️⃣ Base Image
# --------------------------
FROM php:8.3-apache

# Set working directory
WORKDIR /var/www/html

# --------------------------
# 2️⃣ Install required system packages & PHP extensions
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
    && a2enmod rewrite \
    && rm -rf /var/lib/apt/lists/*

# --------------------------
# 3️⃣ Copy Composer from official image
# --------------------------
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# --------------------------
# 4️⃣ Copy composer files first (for caching)
# --------------------------
COPY composer.json composer.lock* ./

# Install PHP dependencies (no dev packages)
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader || true

# --------------------------
# 5️⃣ Copy full Laravel application
# --------------------------
COPY . /var/www/html

# --------------------------
# 6️⃣ Handle environment file (.env)
# --------------------------
RUN if [ -f .env.example ]; then \
      cp .env.example .env; \
    else \
      echo "APP_NAME=Laravel" > .env && \
      echo "APP_ENV=local" >> .env && \
      echo "APP_KEY=" >> .env && \
      echo "APP_DEBUG=true" >> .env && \
      echo "APP_URL=http://localhost" >> .env && \
      echo "DB_CONNECTION=sqlite" >> .env; \
    fi

# --------------------------
# 7️⃣ Generate Laravel app key (skip DB actions)
# --------------------------
RUN php artisan key:generate || true

# --------------------------
# 8️⃣ Fix permissions for Laravel storage & cache
# --------------------------
RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# --------------------------
# 9️⃣ Expose port and start Apache
# --------------------------
EXPOSE 80
CMD ["apache2-foreground"]
