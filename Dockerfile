# Dockerfile
# Étape 1 : image PHP avec extensions nécessaires
FROM php:8.2-fpm

# Installer les dépendances système et extensions PHP
RUN apt-get update && apt-get install -y \
    git unzip curl libpng-dev libonig-dev libxml2-dev \
    libzip-dev zip \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Définir le répertoire de travail
WORKDIR /var/www

# Copier le code
COPY . .

# Installer les dépendances Laravel
RUN composer install --no-dev --optimize-autoloader

# Exposer le port PHP-FPM
EXPOSE 9000

CMD ["php-fpm"]