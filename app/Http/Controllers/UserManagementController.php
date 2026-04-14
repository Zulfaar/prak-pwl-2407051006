<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserManagementController extends Controller
{
    public $userModel;
    public $kelasModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->kelasModel = new Kelas();
    }

    public function index(Request $request)
    {
        $search = $request->search;

        $users = UserModel::join('kelas', 'kelas.id', '=', 'user.kelas_id')
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', "%$search%")
                      ->orWhere('npm', 'like', "%$search%");
            })
            ->select('user.*', 'kelas.nama_kelas')
            ->paginate(5);

        $kelas = Kelas::all();

        return view('user-management', compact('users', 'kelas'));
    }

    public function create()
    {
        $kelas = $this->kelasModel->getKelas();
        return view('create-user', compact('kelas'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'npm' => 'required|string|max:255',
                'kelas_id' => 'required|exists:kelas,id'
            ]);

            $this->userModel->create($validated);

            Log::info('User created successfully');

            return redirect()->route('user-management.index')
                ->with('success', 'User berhasil dibuat');

        } catch (\Exception $e) {

            Log::error('User creation failed: ' . $e->getMessage());

            return redirect()->route('user-management.index')
                ->with('error', 'User gagal dibuat');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'npm' => 'required|string|max:255',
                'kelas_id' => 'required|exists:kelas,id'
            ]);

            DB::transaction(function () use ($id, $validated) {
                $user = UserModel::findOrFail($id);
                $user->update($validated);
            });

            return redirect()->route('user-management.index')
                ->with('success', 'User berhasil diupdate');

        } catch (\Exception $e) {

            Log::error('User update failed: ' . $e->getMessage());

            return redirect()->route('user-management.index')
                ->with('error', 'User gagal diupdate');
        }
    }

    public function destroy($id)
    {
        try {
            DB::transaction(function () use ($id) {
                $user = UserModel::findOrFail($id);
                $user->delete();
            });

            return redirect()->route('user-management.index')
                ->with('success', 'User berhasil dihapus');

        } catch (\Exception $e) {

            Log::error('User delete failed: ' . $e->getMessage());

            return redirect()->route('user-management.index')
                ->with('error', 'User gagal dihapus');
        }
    }
}