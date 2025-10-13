@extends('layouts.app')

@section('content')
    <div class="container">
        <h3 class="mb-4">📩 Detail Tanggapan</h3>

        <div class="card p-4">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th style="width: 200px;">Nama Pelapor</th>
                        <td>{{ $pengaduan->nama ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Deskripsi</th>
                        <td>{{ $pengaduan->deskripsi ?? '-' }}</td>
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
                        <th>Bukti</th>
                        <td>
                            @if ($pengaduan->bukti)
                                <img src="{{ asset('storage/' . $pengaduan->bukti) }}" alt="Bukti Pengaduan"
                                    style="max-width: 300px; height: auto;">
                            @else
                                Tidak ada
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>

            <hr>

            <h5>Tanggapan Admin</h5>
            @if ($pengaduan->tanggapan->count() > 0)
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 50px;">No</th>
                            <th>Isi Tanggapan</th>
                            <th style="width: 200px;">Tanggal Ditanggapi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pengaduan->tanggapan as $index => $t)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $t->isi }}</td>
                                <td>{{ $t->created_at->format('d M Y H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-muted">Belum ada tanggapan.</p>
            @endif

            <a href="{{ route('admin.tanggapan.index') }}" class="btn btn-secondary mt-3 rounded-pill">⬅️ back</a>
        </div>
    </div>
@endsection
                