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
    libpq-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Activer le rewrite Apache
RUN a2enmod rewrite

# Copier les fichiers de l'application
COPY . /var/www/html

# Configurer Apache
COPY .docker/apache.conf /etc/apache2/sites-available/000-default.conf

# ================= CORRECTIONS CRITIQUES =================
# Configurer les permissions STOCKAGE et CACHE (CORRIGÉ)
RUN chown -R www-data:www-data /var/www/html/storage \
    && chown -R www-data:www-data /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache

# Aller dans le dossier de travail
WORKDIR /var/www/html

# Installer les dépendances Composer
RUN composer install --no-dev --no-interaction --optimize-autoloader

# Générer la clé application FORCÉE
RUN if [ ! -f .env ]; then \
        cp .env.example .env; \
    fi && \
    php artisan key:generate --force

# Optimiser Laravel
RUN php artisan optimize:clear

# Exposer le port
EXPOSE 80

# Commande de démarrage
CMD ["apache2-foreground"]