@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Daftar Pengaduan</h3>

        <a href="{{ route('user.pengaduan.create') }}" class="btn btn-primary mb-3">Buat Pengaduan</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Tanggal</th>
                    <th>Lokasi</th>
                    <th>Kategori</th>
                    <th>Status</th>
                    <th>Bukti</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pengaduan as $key => $p)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $p->nama }}</td>
                        <td>{{ \Carbon\Carbon::parse($p->tanggal)->format('d-m-Y') }}</td>
                        <td>{{ $p->lokasi }}</td>

                        {{-- Kategori --}}
                        <td>{{ optional($p->category)->nama ?? '-' }}</td>

                        {{-- Status --}}
                        <td>
                            <span class="badge bg-{{ 
                                $p->status == 'pending' ? 'warning' : 
                                ($p->status == 'proses' ? 'info' : 'success') }}">
                                {{ ucfirst($p->status) }}
                            </span>
                        </td>

                        {{-- Bukti --}}
                        <td>
                            @if($p->bukti)
                                <a href="{{ asset('storage/' . $p->bukti) }}" target="_blank">
                                    <img src="{{ asset('storage/' . $p->bukti) }}" alt="Bukti" style="width: 80px; height: auto;">
                                </a>
                            @else
                                <span class="text-muted">Tidak ada</span>
                            @endif
                        </td>

                        {{-- Aksi --}}
                        <td>
                            <a href="{{ route('user.pengaduan.show', $p->id) }}" class="btn btn-sm btn-info">Detail</a>

                            @if ($p->status == 'pending')
                                <a href="{{ route('user.pengaduan.edit', $p->id) }}" class="btn btn-sm btn-warning">Edit</a>

                                <form action="{{ route('user.pengaduan.destroy', $p->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus pengaduan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">Belum ada pengaduan</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
