@extends('layouts.app')

@section('content')
    <div class="container">
        <h3 class="mb-4">Data Tanggapan 📩</h3>

        {{-- Form Search --}}
        <form method="GET" action="{{ route('admin.tanggapan.index') }}" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="search" value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">search</button>
            </div>
        </form>

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
                        <td>{{ $i + 1 }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($p->deskripsi, 40) }}</td>
                        <td>{{ $p->nama }}</td>

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

                        {{-- Tanggapan --}}
                        <td>
                            @if ($p->tanggapan->count() > 0)
                                {{ $p->tanggapan->last()->isi }}
                            @else
                                -
                            @endif
                        </td>

                        {{-- Aksi --}}
                        <td>
                            {{-- Pending: konfirmasi / tolak --}}
                            @if ($p->status == 'pending')
                                <form action="{{ route('admin.pengaduan.konfirmasi', $p->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm">konfirmasi ✅</button>
                                </form>
                                <form action="{{ route('admin.pengaduan.tolak', $p->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Yakin ingin menolak pengaduan ini?')">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">tolak ❌</button>
                                </form>
                                <a href="{{ route('admin.tanggapan.show', $p->id) }}" class="btn btn-info btn-sm">detail
                                    🔍</a>
                            @endif

                            {{-- Proses --}}
                            @if ($p->status == 'proses')
                                @php
                                    $lastTanggapan = $p->tanggapan->last();
                                @endphp

                                {{-- Kalau belum ada tanggapan manual --}}
                                @if (!$lastTanggapan || $lastTanggapan->isi == 'Pengaduan Anda sedang diproses Admin.')
                                    <form action="{{ route('admin.tanggapan.store', $p->id) }}" method="POST"
                                        class="mb-2">
                                        @csrf
                                        <textarea name="isi" class="form-control mb-2" placeholder="silahkan ketik tanggapan anda ..." required></textarea>
                                        <button type="submit" class="btn btn-primary btn-sm">kirim tanggapan</button>
                                    </form>
                                    <a href="{{ route('admin.tanggapan.show', $p->id) }}"
                                        class="btn btn-info btn-sm">detail 🔍</a>
                                @else
                                    {{-- Kalau sudah ada tanggapan manual --}}
                                    <a href="{{ route('admin.tanggapan.show', $p->id) }}"
                                        class="btn btn-info btn-sm">detail 🔍</a>
                                    <form action="{{ route('admin.pengaduan.selesai', $p->id) }}" method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Yakin ingin menyelesaikan pengaduan ini?')">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">Selesaikan ✅</button>
                                    </form>
                                @endif
                            @endif

                            {{-- Kalau selesai --}}
                            @if ($p->status == 'selesai')
                                <span class="badge bg-success">Pengaduan telah selesai ✅</span>
                            @endif

                            {{-- Kalau ditolak --}}
                            @if ($p->status == 'tolak')
                                <span class="badge bg-danger">Pengaduan Ditolak ❌</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">tidak ada data pengaduan</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
