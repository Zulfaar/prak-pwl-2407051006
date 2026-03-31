@extends('layouts.app')

@section('content')
    <h1 class="text-center">User Management</h1>

    <p class="text-center">ini adalah halaman user management</p>

    <!-- tombol tambah -->
    <div class="text-center mb-3">
        <a class="btn btn-primary" href="{{ route('user-management.create') }}">
            Tambah User
        </a>
    </div>

    <!-- tabel -->
    <table border="1" cellpadding="10" style="margin: 0 auto;">
        <tr style="background-color: #0000ff; color:white;">
            <th>ID</th>
            <th>Nama</th>
            <th>NPM</th>
            <th>Kelas</th>
            <th>Aksi</th>
        </tr>

        @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->npm }}</td>
                <td>{{ $user->nama_kelas }}</td>
                <td>
                    <!-- tombol edit -->
                    <button type="button" class="btn btn-primary"
                        data-bs-toggle="modal"
                        data-bs-target="#editModal{{ $user->id }}">
                        Edit
                    </button>

                    <!-- tombol hapus -->
                    <form action="{{ route('user-management.destroy', $user->id) }}"
                        method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    <!-- MODAL EDIT -->
    @foreach ($users as $user)
    <div class="modal fade" id="editModal{{ $user->id }}" tabindex="-1"
        aria-labelledby="editModalLabel{{ $user->id }}" aria-hidden="true">

        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel{{ $user->id }}">
                        Edit User
                    </h5>
                    <button type="button" class="btn-close"
                        data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <form action="{{ route('user-management.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" class="form-control"
                                name="name" value="{{ $user->name }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">NPM</label>
                            <input type="text" class="form-control"
                                name="npm" value="{{ $user->npm }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Kelas</label>
                            <select class="form-select" name="kelas_id">
                                @foreach ($kelas as $k)
                                    <option value="{{ $k->id }}"
                                        {{ $k->id == $user->kelas_id ? 'selected' : '' }}>
                                        {{ $k->nama_kelas }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">
                                Close
                            </button>
                            <button type="submit" class="btn btn-primary">
                                Simpan
                            </button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
    @endforeach

@endsection