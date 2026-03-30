<?php


namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kelas;
use App\Models\UserModel;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'Fikri',
                'npm' => '2317051061',
                'kelas_id' => Kelas::where('nama_kelas', 'A')->first()->id
            ]
        ];


        foreach ($users as $user) {
            UserModel::create($user);
        }
    }
}



