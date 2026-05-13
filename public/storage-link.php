<?php
// Deteksi path otomatis berdasarkan lokasi file ini
// File ini ada di public_html/, Laravel ada di laravel_app/

$publicHtml = __DIR__;  // path ke folder public_html
$laravelApp = dirname($publicHtml) . '/laravel_app';

$target = $laravelApp . '/storage/app/public';
$link   = $publicHtml . '/storage';

echo "<pre>";
echo "public_html : $publicHtml\n";
echo "laravel_app : $laravelApp\n";
echo "target      : $target\n";
echo "link        : $link\n\n";

// Cek apakah target folder ada
if (!is_dir($target)) {
    echo "❌ Folder target tidak ditemukan: $target\n";
    echo "Pastikan path laravel_app sudah benar.\n";
    exit;
}

if (is_link($link)) {
    echo "✅ Symlink sudah ada → " . readlink($link) . "\n";
} elseif (is_dir($link)) {
    echo "⚠️ Folder 'storage' sudah ada tapi bukan symlink.\n";
    echo "Hapus folder public_html/storage dulu via File Manager, lalu akses halaman ini lagi.\n";
} else {
    if (symlink($target, $link)) {
        echo "✅ Symlink berhasil dibuat!\n";
        echo "Gambar sekarang bisa diakses via /storage/...\n";
    } else {
        echo "❌ Gagal membuat symlink.\n";
        echo "Coba cara manual di bawah ini.\n";
    }
}
echo "</pre>";
