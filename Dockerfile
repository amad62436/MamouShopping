# Utiliser une image PHP avec Apache
FROM php:8.2-apache

# Installer les extensions PHP nécessaires à Laravel
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql gd

# Activer mod_rewrite pour Laravel
RUN a2enmod rewrite

# Copier le code de ton projet
COPY . /var/www/html

# Définir le répertoire de travail
WORKDIR /var/www/html

# Installer Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Installer les dépendances Laravel
RUN composer install --no-dev --optimize-autoloader

# Donner les permissions aux dossiers Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Configurer Apache pour pointer sur /public
RUN echo '<VirtualHost *:80> \
    DocumentRoot /var/www/html/public \
    <Directory /var/www/html/public> \
        AllowOverride All \
        Require all granted \
    </Directory> \
</VirtualHost>' > /etc/apache2/sites-available/000-default.conf
