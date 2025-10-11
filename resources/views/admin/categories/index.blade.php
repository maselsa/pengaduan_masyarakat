@extends('layouts.app')

@section('title', 'Data Kategori')

@section('content')
    <div class="container">
        <h3>Data Kategori 🗂️</h3>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary mb-3">+ Add Category</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $key => $category)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $category->name }}</td>
                        <td class="d-flex gap-2">
                            {{-- Tombol Edit --}}
                            <a href="{{ route('admin.categories.edit', $category->id) }}"
                                class="btn btn-warning btn-sm text-white">📝 edit</a>

                            {{-- Tombol Delete --}}
                            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST"
                                onsubmit="return confirm('Yakin mau hapus kategori ini?💔')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">💔 delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">belum ada kategori</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
