<?php
// Debug endpoint untuk cek environment
header('Content-Type: application/json');

$debug = [
    'status' => 'OK',
    'php_version' => PHP_VERSION,
    'extensions' => get_loaded_extensions(),
    'environment' => [
        'APP_KEY' => getenv('APP_KEY') ? 'SET (' . strlen(getenv('APP_KEY')) . ' chars)' : 'MISSING',
        'APP_ENV' => getenv('APP_ENV') ?: 'MISSING',
        'APP_DEBUG' => getenv('APP_DEBUG') ?: 'MISSING',
        'APP_URL' => getenv('APP_URL') ?: 'MISSING',
        'DB_CONNECTION' => getenv('DB_CONNECTION') ?: 'MISSING',
        'DB_HOST' => getenv('DB_HOST') ? 'SET' : 'MISSING',
        'DB_PORT' => getenv('DB_PORT') ?: 'MISSING',
        'DB_DATABASE' => getenv('DB_DATABASE') ?: 'MISSING',
        'DB_USERNAME' => getenv('DB_USERNAME') ? 'SET' : 'MISSING',
        'DB_PASSWORD' => getenv('DB_PASSWORD') ? 'SET (' . strlen(getenv('DB_PASSWORD')) . ' chars)' : 'MISSING',
        'CACHE_DRIVER' => getenv('CACHE_DRIVER') ?: $_ENV['CACHE_DRIVER'] ?? 'MISSING',
        'SESSION_DRIVER' => getenv('SESSION_DRIVER') ?: $_ENV['SESSION_DRIVER'] ?? 'MISSING',
    ],
    'directories' => [
        '/tmp exists' => is_dir('/tmp'),
        '/tmp writable' => is_writable('/tmp'),
        '/tmp/storage exists' => is_dir('/tmp/storage'),
        '/tmp/views exists' => is_dir('/tmp/views'),
        'vendor exists' => file_exists(__DIR__ . '/../vendor/autoload.php'),
        'bootstrap exists' => file_exists(__DIR__ . '/../bootstrap/app.php'),
    ],
    'laravel_test' => 'Will attempt Laravel boot...'
];

// Try to boot Laravel
try {
    require __DIR__ . '/../vendor/autoload.php';
    $app = require_once __DIR__ . '/../bootstrap/app.php';
    $debug['laravel_boot'] = 'SUCCESS';
    $debug['laravel_version'] = $app->version();
} catch (Throwable $e) {
    $debug['laravel_boot'] = 'FAILED';
    $debug['laravel_error'] = [
        'message' => $e->getMessage(),
        'file' => $e->getFile(),
        'line' => $e->getLine(),
        'trace' => array_slice($e->getTrace(), 0, 5)
    ];
}

echo json_encode($debug, JSON_PRETTY_PRINT);
