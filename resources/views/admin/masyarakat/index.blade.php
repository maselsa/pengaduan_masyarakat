@extends('layouts.app')

@section('title', 'Data Masyarakat')

@section('content')
    <div class="container">
        <h2 class="mb-4">Data Masyarakat 🧑‍🤝‍🧑</h2>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
       <table class="table table-bordered">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Jumlah Pengaduan</th>
                    <th>Tanggal Terakhir Pengaduan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($masyarakat as $index => $m)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $m->name }}</td>
                        <td>{{ $m->pengaduan->count() }}</td>
                        <td>
                            @if ($m->pengaduan->count() > 0)
                                {{ $m->pengaduan->sortByDesc('created_at')->first()->created_at->format('d-m-Y') }}
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">Belum ada data masyarakat</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
