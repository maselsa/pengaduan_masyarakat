@extends('layouts.app')

@section('title', 'Data Pengaduan ')

@section('content')
    <div class="container">
        <h3 class="mb-4">Data Pengaduan 📢</h3>

        {{-- Form Search --}}
        <form method="GET" action="{{ route('admin.pengaduan.index') }}" class="mb-3">
            <div class="input-group" style="gap: 8px;">
                <input type="text" name="search" class="form-control rounded-pill" placeholder="search name complaint ..."
                    value="{{ request('search') }}" style="width: 280px;">
                <button type="submit" class="btn btn-primary rounded-pill px-4 fw-semibold">
                    search
                </button>
            </div>
        </form>

        {{-- Notifikasi sukses --}}
        @if (session('success'))
            <div class="alert alert-success text-center rounded-pill shadow-sm">{{ session('success') }}</div>
        @endif

        {{-- Grid Card Layout --}}
        <div class="row">
            @foreach ($pengaduan as $p)
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-4">
                    <div class="card border-0 shadow-sm h-100 hover-card" style="border-radius: 20px; overflow: hidden;">
                        <div class="position-relative">
                            <img src="{{ $p->bukti ? asset('storage/' . $p->bukti) : asset('img/noimage.png') }}"
                                alt="Bukti" class="card-img-top" style="height:180px; object-fit:cover;">

                            {{-- kategori --}}
                            <span class="position-absolute top-0 start-0 m-2 badge"
                                style="background:rgba(255,105,180,0.9); font-size:13px; color:white; border-radius:12px;">
                                {{ $p->category?->name ?? 'Tanpa Kategori' }}
                            </span>

                            {{-- status --}}
                            <span
                                class="position-absolute top-0 end-0 m-2 badge
                                @if ($p->status == 'selesai') bg-success
                                @elseif($p->status == 'proses') bg-primary
                                @elseif($p->status == 'tolak') bg-danger
                                @else bg-warning @endif"
                                style="font-size:13px; border-radius:12px;">
                                {{ ucfirst($p->status) }}
                            </span>
                        </div>

                        <div class="card-body text-center">
                            <h5 class="card-title fw-bold mb-1" style="color:#d63384;">
                                {{ ucfirst($p->user->name) }}
                            </h5>
                            <small class="text-muted d-block mb-2">{{ $p->tanggal }}</small>
                            <p class="text-secondary" style="font-size:13px;">{{ $p->lokasi }}</p>

                            <div class="d-flex justify-content-center gap-2 mt-3">
                                <a href="{{ route('admin.pengaduan.show', $p->id) }}" class="btn btn-sm fw-semibold px-3">
                                    🗒️ detail
                                </a>
                                <form action="{{ route('admin.pengaduan.destroy', $p->id) }}" method="POST"
                                    onsubmit="return confirm('yakin mau hapus data ini?💔')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm fw-semibold px-3">
                                        💔 delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
