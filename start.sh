#!/bin/bash
# start.sh - Script personnalisé pour Render

# 1. Tuer Apache s'il est en cours d'exécution
echo "🛑 Arrêt d'Apache..."
pkill -f apache2 || true
pkill -f httpd || true

# 2. Attendre que les ports soient libérés
echo "⏳ Libération du port $PORT..."
sleep 2

# 3. Démarrer Laravel avec PHP built-in server
echo "🚀 Démarrage de Laravel sur le port $PORT..."
php artisan serve --port=$PORT --host=0.0.0.0