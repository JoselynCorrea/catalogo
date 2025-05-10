FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    curl \
    git \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql mbstring exif pcntl bcmath gd

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Crear y usar un directorio para la app
WORKDIR /var/www

# Copiar archivos del proyecto
COPY . .

# Instalar dependencias de Laravel
RUN composer install --optimize-autoloader --no-dev

# Asignar permisos
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Puerto por defecto
EXPOSE 8000

# Comando de inicio: usar servidor embebido de PHP
CMD php artisan config:cache && php artisan serve --host=0.0.0.0 --port=8000
