@extends('layouts.app')

@section('content')
    <div class="container">
        <h3 class="mb-4">📩 Tanggapan Pengaduan</h3>

        {{-- Notifikasi sukses --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Pengaduan</th>
                    <th>Kategori</th>
                    <th>Status</th>
                    <th>Tanggapan Admin</th>
                    <th>Waktu</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pengaduan as $i => $p)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($p->deskripsi, 30) }}</td>
                        <td>{{ $p->category->nama ?? '-' }}</td>
                        <td>
                            <span
                                class="badge bg-{{ $p->status == 'selesai' ? 'success' : ($p->status == 'proses' ? 'warning' : 'secondary') }}">
                                {{ ucfirst($p->status) }}
                            </span>
                        </td>
                        <td>
                            @if ($p->tanggapan->count())
                                <ul class="mb-0 list-unstyled">
                                    @foreach ($p->tanggapan as $t)
                                        <li>
                                            {{ $t->tanggapan }}
                                            <br>
                                            <small class="text-muted">{{ $t->created_at->format('d-m-Y H:i') }}</small>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <span class="text-muted">Belum ada tanggapan</span>
                            @endif
                        </td>
                        <td>{{ $p->updated_at->format('d-m-Y H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Belum ada pengaduan / tanggapan</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
