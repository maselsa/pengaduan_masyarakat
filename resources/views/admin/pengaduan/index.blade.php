@extends('layouts.app')

@section('content')
    <div class="container">
        <h3 class="mb-4">Data Pengaduan</h3>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>No HP</th>
                    <th>Tanggal</th>
                    <th>Lokasi</th>
                    <th>Kategori</th>
                    <th>Deskripsi</th>
                    <th>Bukti</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pengaduan as $p)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $p->nama }}</td>
                        <td>{{ $p->email }}</td>
                        <td>{{ $p->no_hp }}</td>
                        <td>{{ $p->tanggal }}</td>
                        <td>{{ $p->lokasi }}</td>
                        <td>{{ $p->category?->name ?? '-' }}</td>
                        <td>{{ Str::limit($p->deskripsi, 30) }}</td>
                        <td>
                            @if ($p->bukti)
                                <img src="{{ asset('storage/' . $p->bukti) }}" alt="Bukti"
                                    style="max-width: 80px; height: auto;">
                            @else
                                Tidak ada
                            @endif
                        </td>

                        <td>
                            <a href="{{ route('admin.pengaduan.show', $p->id) }}" class="btn btn-info btn-sm">Detail</a>

                            <form action="{{ route('admin.pengaduan.destroy', $p->id) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Yakin mau hapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
