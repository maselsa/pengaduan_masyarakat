@extends('layouts.app')

@section('title', 'Data Masyarakat ')

@section('content')
    <div class="container">
        <h2 class="mb-4">Data Masyarakat 👥</h2>

        {{-- Form Search --}}
        <form method="GET" action="{{ route('admin.masyarakat.index') }}" class="mb-3">
            <div class="input-group" style="gap: 8px;">
                <input type="text" name="search" class="form-control rounded-pill" placeholder="search name ..."
                    value="{{ request('search') }}" style="width: 280px;">
                <button type="submit" class="btn btn-primary rounded-pill px-4 fw-semibold">
                    search
                </button>
            </div>
        </form>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered table-striped">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Jumlah Pengaduan</th>
                    <th>Tanggal Terakhir Pengaduan</th>
                    <th>Tanggal Daftar</th>
                </tr>
            </thead>
            <tbody>
                @forelse($masyarakat as $index => $m)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            @if ($m->foto)
                                <img src="{{ asset('storage/' . $m->foto) }}" alt="Foto Profil" width="40"
                                    height="40" class="rounded-circle">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($m->nama) }}&background=ff9be6&color=fff"
                                    alt="Foto Profil" width="40" height="40" class="rounded-circle">
                            @endif
                        </td>
                        <td>{{ $m->name }}</td>
                        <td>{{ $m->email ?? '-' }}</td>
                        <td>{{ $m->pengaduan->count() }}</td>
                        <td>
                            @if ($m->pengaduan->count() > 0)
                                {{ \Carbon\Carbon::parse($m->pengaduan->sortByDesc('tanggal')->first()->tanggal)->format('d-m-Y') }}
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ $m->created_at->format('d-m-Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">Belum Ada Data Masyarakat</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
