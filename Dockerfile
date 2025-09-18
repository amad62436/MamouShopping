FROM php:8.2-apache

# Mettre à jour et installer les dépendances
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Activer le rewrite Apache
RUN a2enmod rewrite

# Copier les fichiers de l'application
COPY . /var/www/html

# Configurer les permissions CRITIQUES
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache

# Aller dans le dossier de travail
WORKDIR /var/www/html

# Installer les dépendances Composer
RUN composer install --no-dev --no-interaction --optimize-autoloader

# Créer le .env si absent et générer la clé
RUN if [ ! -f .env ]; then \
        cp .env.example .env; \
    fi

# Exposer le port
EXPOSE 80

# Commande de démarrage
CMD ["sh", "-c", "php artisan optimize:clear && php artisan key:generate --force && apache2-foreground"]