FROM php:8.2-cli

# Cài các extension PHP cần thiết cho Laravel + PostgreSQL
RUN apt-get update && apt-get install -y \
    git unzip libpq-dev libzip-dev libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_pgsql pgsql mbstring zip bcmath gd \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Cài Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Copy code vào container
COPY . .

# Cài dependencies Laravel
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Set quyền cho thư mục storage và bootstrap/cache
RUN chmod -R 777 storage bootstrap/cache

EXPOSE 8080

# Chạy migration + serve
CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=8080