@extends('layouts.app')

@section('content')
    <div class="container">
        <h3 class="mb-4">💬 Feedback Pengaduan</h3>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Deskripsi</th>
                    <th>Status</th>
                    <th>Tanggapan</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pengaduan as $p)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $p->nama }}</td>
                        <td>{{ Str::limit($p->deskripsi, 50) }}</td>
                        <td>{{ $p->status ?? 'Pending' }}</td>
                        <td>{{ $p->tanggapan ?? '-' }}</td>
                        <td>{{ $p->created_at->format('d-m-Y') }}</td>
                        <td>
                            <form action="{{ route('pengaduan.feedback', $p->id) }}" method="POST" class="d-inline">
                                @csrf
                                <select name="status" class="form-select d-inline w-auto">
                                    <option value="Diproses">Diproses</option>
                                    <option value="Selesai">Selesai</option>
                                    <option value="Ditolak">Ditolak</option>
                                </select>
                                <input type="text" name="tanggapan" placeholder="Tulis tanggapan..."
                                    class="form-control d-inline w-auto">
                                <button type="submit" class="btn btn-success btn-sm">Kirim</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
