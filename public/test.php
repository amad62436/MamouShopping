<?php
header('Content-Type: text/plain');
echo "=== DEBUG SERVER ===\n";
echo "PHP Version: " . PHP_VERSION . "\n";
echo "Server Software: " . ($_SERVER['SERVER_SOFTWARE'] ?? 'N/A') . "\n";
echo "Document Root: " . ($_SERVER['DOCUMENT_ROOT'] ?? 'N/A') . "\n";
echo "Script Path: " . ($_SERVER['SCRIPT_FILENAME'] ?? 'N/A') . "\n";
echo "Current Dir: " . getcwd() . "\n";
echo "Port: " . (getenv('PORT') ?? '10000') . "\n";

// Test base path
$basePath = realpath(__DIR__ . '/../');
echo "Base Path: " . $basePath . "\n";
echo "Public Path: " . realpath(__DIR__) . "\n";

// Test écriture storage
echo "Storage writable: " . (is_writable($basePath . '/storage') ? 'YES' : 'NO') . "\n";