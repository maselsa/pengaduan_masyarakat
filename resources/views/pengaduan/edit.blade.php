@extends('layouts.app')

@section('title', 'Edit Pengaduan')

@section('content')
    <div class="container">
        <h2 class="mb-4">Edit Status Pengaduan</h2>

        <form action="{{ route('pengaduan.update', $pengaduan->id) }}" method="POST">
            @csrf @method('PUT')

            <div class="mb-3">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="Pending" {{ $pengaduan->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Diproses" {{ $pengaduan->status == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                    <option value="Selesai" {{ $pengaduan->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
            </div>

            <button class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
