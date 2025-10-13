@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4">📩 Detail Tanggapan</h3>

    {{-- Card Pengaduan --}}
    <div class="card shadow-sm p-4 mb-4">
        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <th style="width:200px;">Kategori</th>
                    <td>{{ $pengaduan->category->name ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Nama Pelapor</th>
                    <td>{{ $pengaduan->user->name ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Tanggal</th>
                    <td>{{ $pengaduan->tanggal }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        <span class="badge 
                            {{ $pengaduan->status == 'selesai' ? 'bg-success' :
                               ($pengaduan->status == 'tolak' ? 'bg-danger' :
                               ($pengaduan->status == 'pending' ? 'bg-warning' : 
                               ($pengaduan->status == 'proses' ? 'bg-primary' : 'bg-secondary'))) }}">
                            {{ ucfirst($pengaduan->status) }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <th>Deskripsi</th>
                    <td>{{ $pengaduan->deskripsi }}</td>
                </tr>
                <tr>
                    <th>Bukti</th>
                    <td>
                        @if($pengaduan->bukti)
                            <img src="{{ asset('storage/' . $pengaduan->bukti) }}" alt="Bukti Pengaduan" style="max-width:300px;">
                        @else
                            Tidak ada
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- Tanggapan --}}
    <h5 class="mb-3">💬 Tanggapan Admin</h5>
    @if($pengaduan->tanggapan->count() > 0)
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th style="width:50px;">No</th>
                    <th>Isi Tanggapan</th>
                    <th style="width:200px;">Tanggal Ditanggapi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pengaduan->tanggapan as $index => $t)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $t->isi }}</td>
                        <td>{{ $t->created_at->format('d-m-Y H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-muted">Belum ada tanggapan.</p>
    @endif

    <a href="{{ route('user.tanggapan.index') }}" class="btn btn-secondary mt-3 rounded-pill">⬅️ back</a>
</div>

{{-- Style badge --}}
<style>
    .badge-pending { background-color: #ffc107; }
    .badge-proses { background-color: #0dcaf0; }
    .badge-selesai { background-color: #28a745; }
    .badge-tolak { background-color: #dc3545; }
</style>
@endsection
