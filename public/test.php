<?php
header('Content-Type: text/plain');
echo "=== TEST PHP ===\n";
echo "PHP Version: " . PHP_VERSION . "\n";
echo "Server: " . $_SERVER['SERVER_SOFTWARE'] . "\n";
echo "Document Root: " . $_SERVER['DOCUMENT_ROOT'] . "\n";
echo "Working Directory: " . getcwd() . "\n";