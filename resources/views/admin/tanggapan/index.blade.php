@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4">📩 Daftar Tanggapan</h3>

    {{-- Notifikasi sukses --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Pengaduan</th>
                <th>Nama Pelapor</th>
                <th>Status</th>
                <th>Tanggapan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pengaduan as $i => $p)
                <tr>
                    <td>{{ $i+1 }}</td>
                    {{-- Anggap deskripsi jadi judul pengaduan --}}
                    <td>{{ \Illuminate\Support\Str::limit($p->deskripsi, 30) }}</td>
                    <td>{{ $p->nama }}</td>
                    <td>
                        <span class="badge bg-{{ $p->status == 'selesai' ? 'success' : ($p->status == 'proses' ? 'warning' : 'secondary') }}">
                            {{ ucfirst($p->status) }}
                        </span>
                    </td>
                    <td>{{ $p->tanggapan_admin ?? '-' }}</td>
                    <td>
                        @if(!$p->tanggapan_admin)
                            <form action="{{ route('admin.tanggapan.store', $p->id) }}" method="POST">
                                @csrf
                                <div class="input-group">
                                    <input type="text" name="tanggapan_admin" class="form-control" placeholder="Tulis tanggapan..." required>
                                    <button type="submit" class="btn btn-primary">Kirim</button>
                                </div>
                            </form>
                        @else
                            ✅ Sudah ditanggapi
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Tidak ada data pengaduan</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
