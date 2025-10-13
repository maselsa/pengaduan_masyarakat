@extends('layouts.app')

@section('content')
    <div class="container">
        <h3 class="mb-4">Data Tanggapan 📩</h3>

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
                        <td>
                            <span
                                class="badge bg-{{ $p->status == 'selesai' ? 'success' : ($p->status == 'proses' ? 'warning' : 'secondary') }}">
                                {{ ucfirst($p->status) }}
                            </span>
                        </td>
                        <td>{{ $p->tanggapan->isi ?? '-' }}</td>
                        <td>
                            {{-- Tombol konfirmasi (kalau masih pending) --}}
                            @if ($p->status == 'pending')
                                <form action="{{ route('admin.pengaduan.konfirmasi', $p->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-success btn-sm">Konfirmasi ✅</button>
                                </form>
                            @endif

                            {{-- Edit / Hapus tanggapan --}}
                            @if ($p->tanggapan)
                                <div class="mb-2">
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="collapse"
                                        data-bs-target="#editForm{{ $p->tanggapan->id }}">Edit 📝</button>

                                    <form action="{{ route('admin.tanggapan.destroy', $p->tanggapan->id) }}" method="POST"
                                        class="d-inline" onsubmit="return confirm('Yakin ingin menghapus tanggapan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete 💔</button>
                                    </form>

                                    <div id="editForm{{ $p->tanggapan->id }}" class="collapse mt-2">
                                        <form action="{{ route('admin.tanggapan.update', $p->tanggapan->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')
                                            <textarea name="isi" class="form-control" required>{{ $p->tanggapan->isi }}</textarea>
                                            <button type="submit" class="btn btn-success mt-2">Simpan Perubahan</button>
                                        </form>
                                    </div>
                                </div>
                            @endif

                            {{-- Tambah tanggapan kalau status proses --}}
                            @if ($p->status == 'proses')
                                <form action="{{ route('admin.tanggapan.store', $p->id) }}" method="POST" class="mt-2">
                                    @csrf
                                    <textarea name="isi" class="form-control" placeholder="Tulis tanggapan admin..." required></textarea>
                                    <button type="submit" class="btn btn-primary mt-2">Kirim Tanggapan</button>
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
