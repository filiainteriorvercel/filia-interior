<?php
// Migration & Seeding Endpoint for Vercel

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

// Set environment
$_ENV['APP_STORAGE'] = '/tmp/storage';

// Create tmp directories
$dirs = ['/tmp/storage/framework/cache/data', '/tmp/storage/framework/sessions', '/tmp/storage/framework/views', '/tmp/storage/logs'];
foreach ($dirs as $dir) {
    if (!is_dir($dir)) @mkdir($dir, 0755, true);
}

// Security check - only allow in debug mode
if (env('APP_DEBUG') !== 'true' && env('APP_DEBUG') !== true) {
    http_response_code(403);
    die(json_encode(['error' => 'Forbidden - Set APP_DEBUG=true to run migrations']));
}

$action = $_GET['action'] ?? 'status';

try {
    $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
    
    switch ($action) {
        case 'migrate':
            echo "<h2>Running Migrations...</h2><pre>";
            $kernel->call('migrate', ['--force' => true]);
            echo $kernel->output();
            echo "</pre><p>✅ Migrations completed!</p>";
            break;
            
        case 'seed':
            echo "<h2>Running Seeders...</h2><pre>";
            $kernel->call('db:seed', ['--force' => true]);
            echo $kernel->output();
            echo "</pre><p>✅ Seeding completed!</p>";
            echo "<h3>Test Users Created:</h3>";
            echo "<ul>";
            echo "<li><strong>Owner:</strong> filiainterior@gmail.com / password</li>";
            echo "<li><strong>Customer 1:</strong> customer1@gmail.com / password</li>";
            echo "<li><strong>Customer 2:</strong> customer2@gmail.com / password</li>";
            echo "</ul>";
            break;
            
        case 'migrate-fresh':
            echo "<h2>Fresh Migration (Drop All Tables)...</h2><pre>";
            $kernel->call('migrate:fresh', ['--force' => true, '--seed' => true]);
            echo $kernel->output();
            echo "</pre><p>✅ Fresh migration with seeding completed!</p>";
            break;
            
        case 'status':
        default:
            echo "<h2>Database Migration Status</h2>";
            echo "<h3>Available Actions:</h3>";
            echo "<ul>";
            echo "<li><a href='?action=migrate'>Run Migrations</a> - Create tables</li>";
            echo "<li><a href='?action=seed'>Run Seeders</a> - Insert test data</li>";
            echo "<li><a href='?action=migrate-fresh'>Fresh Migration + Seed</a> - Drop all & recreate</li>";
            echo "</ul>";
            
            echo "<h3>Current Migrations:</h3><pre>";
            $kernel->call('migrate:status');
            echo $kernel->output();
            echo "</pre>";
            break;
    }
    
} catch (Exception $e) {
    http_response_code(500);
    echo "<h2>❌ Error:</h2>";
    echo "<pre>" . htmlspecialchars($e->getMessage()) . "</pre>";
    echo "<pre>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
}
