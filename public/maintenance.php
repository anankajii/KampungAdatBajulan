<?php
// Hapus setelah digunakan!

echo "<pre>";

// 1. Kosongkan log
$logFile = __DIR__ . '/../storage/logs/laravel.log';
if (file_exists($logFile)) {
    file_put_contents($logFile, '');
    echo "✅ Log dikosongkan\n";
}

// 2. Hapus view cache
$viewPath = __DIR__ . '/../storage/framework/views';
$files = glob($viewPath . '/*.php');
$count = 0;
foreach ($files as $file) {
    if (unlink($file)) $count++;
}
echo "✅ View cache: {$count} file dihapus\n";

// 3. Hapus bootstrap cache
$cacheFiles = [
    __DIR__ . '/../bootstrap/cache/config.php',
    __DIR__ . '/../bootstrap/cache/services.php',
    __DIR__ . '/../bootstrap/cache/packages.php',
    __DIR__ . '/../bootstrap/cache/routes-v7.php',
    __DIR__ . '/../bootstrap/cache/events.php',
];
$deleted = 0;
foreach ($cacheFiles as $f) {
    if (file_exists($f) && unlink($f)) {
        echo "✅ Deleted: " . basename($f) . "\n";
        $deleted++;
    }
}
if ($deleted === 0) echo "ℹ️  Tidak ada bootstrap cache\n";

// 4. Hapus session files lama (opsional)
$sessionPath = __DIR__ . '/../storage/framework/sessions';
$sessions = glob($sessionPath . '/*');
$sessionCount = 0;
foreach ($sessions as $s) {
    if (is_file($s) && basename($s) !== '.gitignore') {
        unlink($s);
        $sessionCount++;
    }
}
echo "✅ Session lama: {$sessionCount} file dihapus\n";

echo "\n✅ Selesai! Hapus file ini sekarang.\n";
echo "</pre>";
