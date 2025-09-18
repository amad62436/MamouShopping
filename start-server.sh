#!/bin/bash
# start-server.sh - Force PHP Server seulement

# 1. Tuer tout processus Apache restant
echo "🔪 Killing any remaining Apache processes..."
pkill -9 -f apache2 || true
pkill -9 -f httpd || true

# 2. Vérifier que le port est libre
echo "🔍 Checking port $PORT..."
netstat -tulpn | grep :$PORT && echo "❌ Port $PORT already in use!" && exit 1

# 3. Démarrer PHP Server
echo "🚀 Starting PHP Server on port $PORT..."
php artisan serve --port=$PORT --host=0.0.0.0