<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "=== SYNCING DATA FROM LOCAL TO AIVEN ===\n\n";

try {
    // Disable foreign key checks
    DB::connection('aiven')->statement('SET FOREIGN_KEY_CHECKS=0');
    
    // Tables to sync (order matters due to foreign keys)
    $tables = ['users', 'contacts', 'portfolios', 'progress_updates'];
    
    foreach ($tables as $table) {
        echo "Syncing table: {$table}...\n";
        
        // Get data from local
        $localData = DB::connection('mysql')->table($table)->get();
        
        if ($localData->count() > 0) {
            // Clear Aiven table first
            DB::connection('aiven')->table($table)->delete();
            
            // Insert data to Aiven
            foreach ($localData as $row) {
                DB::connection('aiven')->table($table)->insert((array)$row);
            }
            
            echo "  ✅ Synced {$localData->count()} records\n";
        } else {
            echo "  ⚠️  No data to sync\n";
        }
    }
    
    // Re-enable foreign key checks
    DB::connection('aiven')->statement('SET FOREIGN_KEY_CHECKS=1');
    
    echo "\n=== SYNC COMPLETED SUCCESSFULLY ===\n\n";
    
    // Verify sync
    echo "=== VERIFICATION ===\n";
    foreach ($tables as $table) {
        $localCount = DB::connection('mysql')->table($table)->count();
        $aivenCount = DB::connection('aiven')->table($table)->count();
        $status = $localCount === $aivenCount ? '✅' : '❌';
        echo "{$status} {$table}: Local={$localCount}, Aiven={$aivenCount}\n";
    }
    
} catch (\Exception $e) {
    echo "❌ ERROR: " . $e->getMessage() . "\n";
}
