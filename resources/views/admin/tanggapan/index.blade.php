@extends('layouts.app')

@section('content')
    <div class="container">
        <h3 class="mb-4">Data Tanggapan 📩</h3>

        {{-- Form Search --}}
        <form method="GET" action="{{ route('admin.tanggapan.index') }}" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="search"
                    value="{{ request('search') }}">
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
                        <td>{{ \Illuminate\Support\Str::limit($p->deskripsi, 30) }}</td>
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

                        <td>
                            {{-- Tombol konfirmasi / tolak (kalau masih pending) --}}
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
                            @endif

                            {{-- Edit / Hapus tanggapan (hanya tanggapan terakhir) --}}
                            @if ($p->tanggapan && $p->tanggapan->count() > 0)
                                @php $t = $p->tanggapan->last(); @endphp
                                <div class="mb-2">
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="collapse"
                                        data-bs-target="#editForm{{ $t->id }}">edit 📝</button>

                                    <form action="{{ route('admin.tanggapan.destroy', $t->id) }}" method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Yakin ingin menghapus tanggapan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">delete 💔</button>
                                    </form>

                                    <div id="editForm{{ $t->id }}" class="collapse mt-2">
                                        <form action="{{ route('admin.tanggapan.update', $t->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <textarea name="isi" class="form-control" required>{{ $t->isi }}</textarea>
                                            <button type="submit" class="btn btn-success mt-2">save</button>
                                        </form>
                                    </div>
                                </div>
                            @endif

                            {{-- Tambah tanggapan kalau status proses --}}
                            @if ($p->status == 'proses')
                                <form action="{{ route('admin.tanggapan.store', $p->id) }}" method="POST" class="mt-2">
                                    @csrf
                                    <textarea name="isi" class="form-control" placeholder="silahkan ketik tanggapan anda ..." required></textarea>
                                    <button type="submit" class="btn btn-primary mt-2">kirim tanggapan</button>
                                </form>
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
