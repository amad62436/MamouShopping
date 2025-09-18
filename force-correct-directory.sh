#!/bin/bash
# Script pour forcer Apache à servir le bon répertoire

echo "🔧 Configuration d'Apache pour le bon répertoire..."

# 1. Arrêter Apache
sudo service apache2 stop

# 2. Supprimer la configuration par défaut
sudo rm -f /etc/apache2/sites-enabled/000-default.conf
sudo rm -f /etc/apache2/sites-available/000-default.conf

# 3. Copier notre configuration personnalisée
sudo cp /opt/render/project/src/apache-config.conf /etc/apache2/sites-available/mamou-shopping.conf

# 4. Activer notre site
sudo a2dissite 000-default
sudo a2ensite mamou-shopping

# 5. Activer les modules nécessaires
sudo a2enmod rewrite
sudo a2enmod headers

# 6. Redémarrer Apache
sudo service apache2 restart

echo "✅ Apache configuré pour servir /opt/render/project/src/public"
echo "🌐 Vérification sur http://localhost:$PORT"

# Garder le script en vie
sleep infinity