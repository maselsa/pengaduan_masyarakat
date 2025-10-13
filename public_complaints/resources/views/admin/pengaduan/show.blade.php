@extends('layouts.app')

@section('content')
    <div class="container">
        <h3 class="mb-4">🗒️ Detail Pengaduan</h3>

        <div class="card shadow-sm p-4">
            <table class="table table-bordered table-striped">
                <tr>
                    <th style="width: 30%;">Nama</th>
                    <td>{{ $pengaduan->user->nama }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $pengaduan->user->email }}</td>
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
                    <td>{{ $pengaduan->category->name ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Deskripsi</th>
                    <td style="text-align: justify;">{{ $pengaduan->deskripsi }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        <span class="badge bg-{{ $pengaduan->status == 'selesai' ? 'success' : 'warning' }}">
                            {{ ucfirst($pengaduan->status) }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <th>Bukti</th>
                    <td>
                        @if ($pengaduan->bukti)
                            <img src="{{ asset('storage/' . $pengaduan->bukti) }}" alt="Bukti Pengaduan"
                                class="img-fluid rounded shadow-sm" style="max-width: 300px;">
                        @else
                            Tidak ada
                        @endif
                    </td>
                </tr>
            </table>

            <a href="{{ route('admin.pengaduan.index') }}" 
            class="btn btn-pink mt-3">⬅️ back</a>
        </div>
    </div>
@endsection
