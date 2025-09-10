@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Detail Pengaduan</h3>

        <table class="table table-bordered">
            <tr>
                <th>Nama</th>
                <td>{{ $pengaduan->nama }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $pengaduan->email }}</td>
            </tr>
            <tr>
                <th>No HP</th>
                <td>{{ $pengaduan->no_hp }}</td>
            </tr>
            <tr>
                <th>Tanggal</th>
                <td>{{ $pengaduan->tanggal }}</td>
            </tr>
            <tr>
                <th>Lokasi</th>
                <td>{{ $pengaduan->lokasi }}</td>
            </tr>
            <tr>
                <th>Kategori</th>
                <td>{{ $pengaduan->category->nama ?? '-' }}</td>
            </tr>
            <tr>
                <th>Deskripsi</th>
                <td>{{ $pengaduan->deskripsi }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>{{ ucfirst($pengaduan->status) }}</td>
            </tr>
            <tr>
                <th>Bukti</th>
                <td>
                    @if ($pengaduan->bukti)
                        <a href="{{ asset('storage/' . $pengaduan->bukti) }}" target="_blank">Lihat Bukti</a>
                    @else
                        Tidak ada
                    @endif
                </td>
            </tr>
        </table>

        <a href="{{ route('user.pengaduan.index') }}" class="btn btn-secondary">Kembali</a>
        @if ($pengaduan->status == 'pending')
            <a href="{{ route('user.pengaduan.edit', $pengaduan->id) }}" class="btn btn-warning">Edit</a>
        @endif
    </div>
@endsection
