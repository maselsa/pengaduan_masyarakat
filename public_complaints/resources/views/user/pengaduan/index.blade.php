@extends('layouts.app')

@section('title', 'Pengaduan Masyarakat')

@section('content')
    <div class="container">
        <h3>Data Pengaduan 📢</h3>

        <a href="{{ route('user.pengaduan.create') }}" class="btn btn-primary mb-3">+ Add Pengaduan</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered table-striped">
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
                        <td>{{ $p->user->name }}</td>
                        <td>{{ \Carbon\Carbon::parse($p->tanggal)->format('d-m-Y') }}</td>
                        <td>{{ $p->lokasi }}</td>

                        {{-- Kategori --}}
                        <td>{{ $p->category->name ?? '-' }}</td>

                        {{-- Status --}}
                        <td>
                            <span class="badge 
                               {{ $p->status == 'selesai' ? 'bg-success' : 
                                 ($p->status == 'tolak' ? 'bg-danger' : 
                                 ($p->status == 'pending' ? 'bg-warning' : 
                                 ($p->status == 'proses' ? 'bg-primary' : 'bg-secondary'))) }}">
                               {{ ucfirst($p->status) }}
                            </span>
                        </td>

                        {{-- Bukti --}}
                        <td>
                            @if ($p->bukti)
                                <img src="{{ asset('storage/' . $p->bukti) }}" alt="Bukti"
                                    style="max-width: 80px; height: auto;">
                            @else
                                <span class="text-muted">tidak ada</span>
                            @endif
                        </td>

                        {{-- Aksi --}}
                        <td>
                            <a href="{{ route('user.pengaduan.show', $p->id) }}" class="btn btn-sm btn-info">detail🗒️</a>

                            @if ($p->status == 'pending')
                                <a href="{{ route('user.pengaduan.edit', $p->id) }}"
                                    class="btn btn-sm btn-warning">edit📝</a>

                                <form action="{{ route('user.pengaduan.destroy', $p->id) }}" method="POST"
                                    style="display:inline-block;"
                                    onsubmit="return confirm('yakin ingin menghapus pengaduan ini?💔')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">delete💔</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">Belum Ada Pengaduan</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
