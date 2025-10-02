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
                        <td>{{ \Illuminate\Support\Str::limit($p->deskripsi, 60) }}</td>
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

                        {{-- Tanggapan (hanya manual) --}}
                        <td>
                            @php
                                $manualTanggapan = $p->tanggapan->filter(function ($t) {
                                    return !in_array(strtolower($t->isi), [
                                        'pengaduan selesai',
                                        'pengaduan diproses',
                                        'pengaduan ditolak',
                                        'pengaduan pending',
                                    ]);
                                });
                            @endphp

                            @if ($manualTanggapan->count() > 0)
                                {{ $manualTanggapan->last()->isi }}
                                <br>
                                <small class="text-muted">
                                    {{ $manualTanggapan->last()->created_at->format('d-m-Y H:i') }}
                                </small>
                            @else
                                <span class="text-muted">Belum Ada Tanggapan</span>
                            @endif
                        </td>

                        <td>{{ $p->updated_at->format('d-m-Y H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Belum Ada Pengaduan / Tanggapan</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
