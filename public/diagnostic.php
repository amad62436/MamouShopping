<?php
header('Content-Type: text/plain');
echo "=== DIAGNOSTIC MAMOUSHOPPING ===\n\n";

// 1. Vérifier les permissions
echo "1. PERMISSIONS:\n";
echo "Storage writable: " . (is_writable('../storage') ? 'YES' : 'NO') . "\n";
echo "Bootstrap/cache writable: " . (is_writable('../bootstrap/cache') ? 'YES' : 'NO') . "\n\n";

// 2. Vérifier l'environnement
echo "2. ENVIRONMENT:\n";
echo "APP_ENV: " . (getenv('APP_ENV') ?: 'NOT SET') . "\n";
echo "APP_DEBUG: " . (getenv('APP_DEBUG') ?: 'NOT SET') . "\n";
echo "APP_KEY: " . (getenv('APP_KEY') ? 'SET' : 'NOT SET') . "\n\n";

// 3. Vérifier la base de données
echo "3. DATABASE:\n";
try {
    $pdo = new PDO(
        'mysql:host=' . getenv('DB_HOST') . ';port=' . getenv('DB_PORT'),
        getenv('DB_USERNAME'),
        getenv('DB_PASSWORD')
    );
    echo "Database connection: SUCCESS\n";
} catch (Exception $e) {
    echo "Database connection: FAILED - " . $e->getMessage() . "\n";
}

// 4. Vérifier les extensions PHP
echo "4. PHP EXTENSIONS:\n";
$required = ['pdo_mysql', 'mbstring', 'gd', 'zip'];
foreach ($required as $ext) {
    echo $ext . ": " . (extension_loaded($ext) ? 'LOADED' : 'MISSING') . "\n";
}