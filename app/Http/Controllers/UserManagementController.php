<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\UserModel;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    public $userModel;
    public $kelasModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->kelasModel = new Kelas();
    }

    // READ
    public function index()
    {
        $users = $this->userModel->getUser();
        $kelas = $this->kelasModel->getKelas(); // penting untuk modal edit

        return view('user-management', compact('users', 'kelas'));
    }

    
    public function create()
    {
        $kelas = $this->kelasModel->getKelas();
        return view('create-user', compact('kelas'));
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'npm' => 'required',
            'kelas_id' => 'required'
        ]);

        $this->userModel->create([
            'name' => $request->name, // ⬅️ ini diperbaiki
            'npm' => $request->npm,
            'kelas_id' => $request->kelas_id
        ]);

        return redirect()->route('user-management.index');
    }

    
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'npm' => 'required',
            'kelas_id' => 'required'
        ]);

        $user = UserModel::findOrFail($id);

        $user->update([
            'name' => $request->name,
            'npm' => $request->npm,
            'kelas_id' => $request->kelas_id
        ]);

        return redirect()->route('user-management.index');
    }

    
    public function destroy($id)
    {
        $user = UserModel::findOrFail($id);
        $user->delete();

        return redirect()->route('user-management.index');
    }
}