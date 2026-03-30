@extends('layouts.app')

@section('title', 'User Management')

@section('content')
    <h1 class="text-center">User Management</h1>
    <p class="text-center">Ini adalah halaman user management</p>

    <table class="table table-bordered text-center">
        <thead class="table-primary">
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>NPM</th>
                <th>Kelas</th>
            </tr>
        </thead>
        <tbody>
           @foreach ($users as $user)
<tr>
    <td>{{ $user->id }}</td>
    <td>{{ $user->name }}</td>
    <td>{{ $user->npm }}</td>
    <td>{{ $user->nama_kelas }}</td>
</tr>
@endforeach
        </tbody>
    </table>
@endsection