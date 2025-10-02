@extends('layouts.app')

@section('content')
    <div class="container">
        <h3 class="mb-4">📩 Detail Tanggapan</h3>

        <div class="card p-4">
            <p><strong>Nama Pelapor:</strong> {{ $pengaduan->nama ?? '-' }}</p>
            <p><strong>Deskripsi:</strong> {{ $pengaduan->deskripsi ?? '-' }}</p>
            <p>
                <strong>Status:</strong>
                <span class="badge 
                               {{ $pengaduan->status == 'selesai' ? 'bg-success' : 
                                 ($pengaduan->status == 'tolak' ? 'bg-danger' : 
                                 ($pengaduan->status == 'pending' ? 'bg-warning' : 
                                 ($pengaduan->status == 'proses' ? 'bg-primary' : 'bg-secondary'))) }}">
                               {{ ucfirst($pengaduan->status) }}
                </span>
            </p>

            <p><strong>Bukti:</strong>
                @if ($pengaduan->bukti)
                    <img src="{{ asset('storage/' . $pengaduan->bukti) }}" alt="Bukti Pengaduan"
                        style="max-width: 300px; height: auto;">
                @else
                    Tidak ada
                @endif
            </p>

            <hr>

            <h5>Tanggapan Admin</h5>
            @forelse ($pengaduan->tanggapan as $t)
                <div class="border p-2 mb-2 rounded">
                    <p>{{ $t->isi }}</p>
                    <small class="text-muted">Dibuat: {{ $t->created_at->format('d M Y H:i') }}</small>
                </div>
            @empty
                <p class="text-muted">Belum ada tanggapan.</p>
            @endforelse

            <a href="{{ route('admin.tanggapan.index') }}" class="btn btn-pink w-100 mt-3">⬅️ back</a>
        </div>
    </div>
@endsection
