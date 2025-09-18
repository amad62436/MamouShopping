<?php
header('Content-Type: text/plain');
echo "=== RENDER TEST ===\n";
echo "Server: " . $_SERVER['SERVER_SOFTWARE'] . "\n";
echo "PHP: " . PHP_VERSION . "\n";
echo "Time: " . date('Y-m-d H:i:s') . "\n";
echo "URL: " . $_SERVER['REQUEST_URI'] . "\n";