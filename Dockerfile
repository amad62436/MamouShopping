# Utiliser l'image PHP avec Apache
FROM php:8.2-apache

# Installer les extensions nécessaires à Laravel
RUN apt-get update && apt-get install -y \
    libonig-dev libzip-dev unzip git curl \
    && docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl bcmath

# Activer mod_rewrite
RUN a2enmod rewrite

# Copier les fichiers du projet dans le conteneur
COPY . /var/www/html

# Définir le répertoire de travail
WORKDIR /var/www/html

# Installer Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Donner les droits corrects
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Exposer le port
EXPOSE 10000

# Commande pour lancer Laravel
CMD php artisan serve --host 0.0.0.0 --port 10000
