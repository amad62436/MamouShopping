FROM php:8.2-apache

# Installer extensions PHP nécessaires à Laravel
RUN apt-get update && apt-get install -y \
    libonig-dev libzip-dev unzip git curl \
    && docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl bcmath

# Activer mod_rewrite
RUN a2enmod rewrite

# Copier les fichiers du projet
COPY . /var/www/html

# Copier la config Apache corrigée
COPY ./000-default.conf /etc/apache2/sites-enabled/000-default.conf

# Définir le répertoire de travail
WORKDIR /var/www/html

# Installer Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Droits
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache
