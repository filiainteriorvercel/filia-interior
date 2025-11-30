<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\Mail;

echo "Testing email configuration...\n";
echo "MAIL_MAILER: " . config('mail.default') . "\n";
echo "MAIL_HOST: " . config('mail.mailers.smtp.host') . "\n";
echo "MAIL_PORT: " . config('mail.mailers.smtp.port') . "\n";
echo "MAIL_USERNAME: " . config('mail.mailers.smtp.username') . "\n";
echo "MAIL_FROM: " . config('mail.from.address') . "\n";
echo "\n";

try {
    Mail::raw('Test email dari Laravel - ' . date('Y-m-d H:i:s'), function($message) {
        $message->to('renovansetio0906@gmail.com')
                ->subject('Test Email Laravel');
    });
    echo "SUCCESS: Email berhasil dikirim!\n";
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
    echo "\nFull trace:\n" . $e->getTraceAsString() . "\n";
}
