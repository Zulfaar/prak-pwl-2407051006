<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MataKuliahSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('mata_kuliah')->insert([
            [
                'nama_mk' => 'Pemrograman Web',
                'sks' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_mk' => 'Basis Data',
                'sks' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_mk' => 'Sistem Informasi',
                'sks' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}