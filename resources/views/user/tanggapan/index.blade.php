@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>💬 Tanggapan Admin</h2>

        @if ($pengaduan->isEmpty())
            <p class="text-muted">Belum ada pengaduan yang ditanggapi.</p>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Judul Pengaduan</th>
                        <th>Isi Pengaduan</th>
                        <th>Tanggapan Admin</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pengaduan as $item)
                        <tr>
                            <td>{{ $item->judul ?? '-' }}</td>
                            <td>{{ $item->deskripsi ?? '-' }}</td>
                            <td>
                                @if ($item->tanggapan)
                                    {{ $item->tanggapan->isi }}
                                @else
                                    <em class="text-muted">Belum ada tanggapan</em>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
