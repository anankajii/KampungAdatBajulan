<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class FindEmptyColumns extends Command
{
    protected $signature = 'db:find-empty-columns';
    protected $description = 'Mencari kolom kosong (tidak terpakai) di semua tabel';

    public function handle()
    {
        // Mengambil semua nama tabel di MySQL
        $tables = array_map(function ($table) {
            return array_values((array) $table)[0];
        }, DB::select('SHOW TABLES'));
        $emptyColumns = [];

        $this->info('Memindai seluruh tabel...');

        foreach ($tables as $table) {
            $columns = Schema::getColumnListing($table);
            
            // Skip tabel jika tidak ada datanya sama sekali
            $totalRows = DB::table($table)->count();
            if ($totalRows === 0) {
                continue;
            }

            foreach ($columns as $column) {
                try {
                    // Cari baris yang BUKAN Null dan BUKAN String kosong
                    $notEmptyCount = DB::table($table)
                        ->whereNotNull($column)
                        ->whereRaw("CAST({$column} AS CHAR) != ''")
                        ->count();

                    // Jika tidak ada baris yang terisi (count 0), berarti kolom ini kosong di semua baris
                    if ($notEmptyCount === 0) {
                        $emptyColumns[] = [
                            'Tabel' => $table,
                            'Kolom' => $column,
                        ];
                    }
                } catch (\Exception $e) {
                    // Abaikan tipe data yang tidak bisa dibandingan (seperti JSON/BLOB/Geometry)
                }
            }
        }

        if (empty($emptyColumns)) {
            $this->info("\n✅ Tidak ada kolom kosong yang ditemukan pada tabel yang memiliki data.");
        } else {
            $this->warn("\n⚠️ Ditemukan Kolom Kosong/Tidak Terpakai:");
            $this->table(['Nama Tabel', 'Kolom Kosong'], $emptyColumns);
        }
    }
}
