<?php
// Cek URL yang dihasilkan — hapus setelah digunakan!
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$app->make(\Illuminate\Contracts\Http\Kernel::class)->bootstrap();

echo "<pre>";
echo "APP_URL    : " . config('app.url') . "\n";
echo "url()      : " . url('/') . "\n";
echo "Callback   : " . url('/api/midtrans/callback') . "\n";
echo "appendNotif: " . \Midtrans\Config::$appendNotifUrl . "\n";
echo "</pre>";
