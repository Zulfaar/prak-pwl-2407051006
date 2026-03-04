<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    public function index()
{
    $users = [
         [
            'nama' => 'zulfa',
            'npm' => '2407051006',
            'jurusan' => 'D3 Manajemen Informatika',
            'prodi' => 'Ilmu Komputer'
         ],
         [
            'nama' => 'Defina',
            'npm' => '2407051001',
            'jurusan' => 'D3 Manajemen Informatika',
            'prodi' => 'Ilmu Komputer'
         ],[
            'nama' => 'Rosida',
            'npm' => '2407051007',
            'jurusan' => 'D3 Manajemen Informatika',
            'prodi' => 'Ilmu Komputer'
         ],[
            'nama' => 'Adelia',
            'npm' => '2407051012',
            'jurusan' => 'D3 Manajemen Informatika',
            'prodi' => 'Ilmu Komputer'
         ],
    ];     
    return view ('user-management', compact('users'));
}
}
