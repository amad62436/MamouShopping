<?php
header('Content-Type: application/json');
echo json_encode([
    'status' => 'ok',
    'server' => 'php_builtin',
    'port' => $_SERVER['SERVER_PORT'] ?? 'unknown',
    'document_root' => realpath($_SERVER['DOCUMENT_ROOT'] ?? ''),
    'time' => date('Y-m-d H:i:s'),
    'php_version' => PHP_VERSION
]);