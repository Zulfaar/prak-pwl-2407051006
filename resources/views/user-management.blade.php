@extends('layouts.app')

@section('content')
    <h1 class="text-center">User Management</h1>
    <p class="text-center">ini adalah halaman user management</p>

    <!-- ALERT -->
    @if (session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger text-center">
            {{ session('error') }}
        </div>
    @endif

    <!-- SEARCH -->
    <form method="GET" class="text-center mb-3">
        <input type="text" name="search" placeholder="Cari nama / npm"
            value="{{ request('search') }}">
        <button class="btn btn-primary">Cari</button>
    </form>

    <!-- tombol tambah -->
    <div class="text-center mb-3">
        <a class="btn btn-success" href="{{ route('user-management.create') }}">
            Tambah User
        </a>
    </div>

    <!-- tabel -->
    <table class="table table-bordered table-striped text-center">
        <thead class="table-primary">
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>NPM</th>
                <th>Kelas</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->npm }}</td>
                <td>{{ $user->nama_kelas }}</td>
                <td>
                    <!-- tombol edit -->
                    <button class="btn btn-warning btn-sm"
                        data-bs-toggle="modal"
                        data-bs-target="#editModal{{ $user->id }}">
                        Edit
                    </button>

                    <!-- tombol hapus -->
                    <form action="{{ route('user-management.destroy', $user->id) }}"
                        method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm"
                            onclick="return confirm('Yakin hapus data?')">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <!-- PAGINATION -->
    <div class="d-flex justify-content-center">
        {{ $users->links() }}
    </div>

    <!-- MODAL EDIT -->
    @foreach ($users as $user)
    <div class="modal fade" id="editModal{{ $user->id }}" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Edit User</h5>
                    <button type="button" class="btn-close"
                        data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ route('user-management.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="modal-body">

                        <div class="mb-3">
                            <label>Nama</label>
                            <input type="text" class="form-control"
                                name="name" value="{{ $user->name }}" required>
                        </div>

                        <div class="mb-3">
                            <label>NPM</label>
                            <input type="text" class="form-control"
                                name="npm" value="{{ $user->npm }}" required>
                        </div>

                        <div class="mb-3">
                            <label>Kelas</label>
                            <select class="form-select" name="kelas_id">
                                @foreach ($kelas as $k)
                                    <option value="{{ $k->id }}"
                                        {{ $k->id == $user->kelas_id ? 'selected' : '' }}>
                                        {{ $k->nama_kelas }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">
                            Simpan
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
    @endforeach

@endsection