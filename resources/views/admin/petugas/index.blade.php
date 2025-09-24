@extends('layouts.app')

@section('content')
    <div class="container">
        <h3 class="mb-4">Data Petugas 👮</h3>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="{{ route('admin.petugas.create') }}" class="btn btn-primary mb-3">+ Tambah Petugas</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($petugas as $p)
                    <tr>
                        <td>{{ $p->name }}</td>
                        <td>{{ $p->email }}</td>
                        <td>{{ ucfirst($p->role) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
