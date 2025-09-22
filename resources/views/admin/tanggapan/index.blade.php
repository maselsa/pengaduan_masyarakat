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
                            @if (!$p->tanggapan)
                                {{-- Form tambah tanggapan --}}
                                <form action="{{ route('admin.tanggapan.store', $p->id) }}" method="POST">
                                    @csrf
                                    <textarea name="isi" class="form-control" placeholder="Tulis tanggapan admin..." required></textarea>
                                    <button type="submit" class="btn btn-primary mt-2">Kirim Tanggapan</button>
                                </form>
                            @else
                                {{-- Tombol Edit (collapse) --}}
                                <button class="btn btn-warning btn-sm" data-bs-toggle="collapse"
                                    data-bs-target="#editForm{{ $p->tanggapan->id }}">
                                    Edit
                                </button>

                                {{-- Tombol Hapus --}}
                                <form action="{{ route('admin.tanggapan.destroy', $p->tanggapan->id) }}" method="POST"
                                    class="d-inline"
                                    onsubmit="return confirm('Yakin ingin menghapus tanggapan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>

                                {{-- Form Edit (Collapse Bootstrap) --}}
                                <div id="editForm{{ $p->tanggapan->id }}" class="collapse mt-2">
                                    <form action="{{ route('admin.tanggapan.update', $p->tanggapan->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <textarea name="isi" class="form-control" required>{{ $p->tanggapan->isi }}</textarea>
                                        <button type="submit" class="btn btn-success mt-2">Simpan Perubahan</button>
                                    </form>
                                </div>
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