FROM php:8.2-cli

# Install dependencies
RUN apt-get update && apt-get install -y \
    unzip git curl libzip-dev zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /app

# Copy project
COPY . .

# Install Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

# 🔥 CLEAR & CACHE (PENTING BANGET)
RUN php artisan optimize:clear
RUN php artisan config:clear
RUN php artisan cache:clear
RUN php artisan view:clear

# 🔥 REBUILD CACHE (BIAR CEPAT & BENAR)
RUN php artisan config:cache
RUN php artisan route:cache
RUN php artisan view:cache

# Expose port
EXPOSE 10000

# Run Laravel
CMD php artisan serve --host=0.0.0.0 --port=10000