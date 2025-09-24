@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tanggapan</h2>

    @if($tanggapan->isEmpty())
        <p>Belum ada tanggapan.</p>
    @else
        <table border="1" cellpadding="8">
            <thead>
                <tr>
                    <th>Judul Pengaduan</th>
                    <th>Isi Pengaduan</th>
                    <th>Tanggapan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pengaduan as $item)
                    <tr>
                        <td>{{ $item->judul ?? '-' }}</td>
                        <td>{{ $item->isi ?? '-' }}</td>
                        <td>
                            @if($item->tanggapan)
                                {{ $item->tanggapan->isi }}
                            @else
                                <em>Belum ditanggapi</em>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection