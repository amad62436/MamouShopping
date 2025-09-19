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

# Configurer Apache pour Laravel
RUN echo '<VirtualHost *:80>\n\
    ServerAdmin webmaster@localhost\n\
    DocumentRoot /var/www/html/public\n\
    <Directory /var/www/html/public>\n\
        Options Indexes FollowSymLinks\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>\n\
    ErrorLog ${APACHE_LOG_DIR}/error.log\n\
    CustomLog ${APACHE_LOG_DIR}/access.log combined\n\
</VirtualHost>' > /etc/apache2/sites-available/000-default.conf

# Exposer le port (Render choisit automatiquement le port, donc pas besoin de hardcoder)
EXPOSE 80

# Commande pour lancer Apache
CMD ["apache2-foreground"]
