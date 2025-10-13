@extends('layouts.app')

@section('title', 'Tanggapan Admin ')

@section('content')
    <div class="container">
        <h3 class="mb-4">Data Tanggapan 📩</h3>

        {{--  Search --}}
        <div class="d-flex justify-content-between align-items-center flex-wrap mb-4 gap-3">
            {{-- Search di kiri --}}
            <form method="GET" action="{{ route('admin.tanggapan.index') }}" class="d-flex align-items-center w-auto"
                style="gap: 8px;">
                <input type="text" name="search" class="form-control rounded-pill"
                    placeholder="search name complaint ..." value="{{ request('search') }}" style="width: 280px;">
                <button type="submit" class="btn btn-dark rounded-pill px-4 fw-semibold">Search</button>
            </form>

            {{-- Status Filter di kanan --}}
            <ul class="nav status-tabs flex-wrap mb-0" id="statusTabs">
                <li class="nav-item"><button class="nav-link active bg-secondary text-white" data-bs-toggle="tab"
                        data-bs-target="#semua">All 📋</button></li>
                <li class="nav-item"><button class="nav-link bg-warning text-white" data-bs-toggle="tab"
                        data-bs-target="#pending">Pending ⏳</button></li>
                <li class="nav-item"><button class="nav-link bg-info text-white" data-bs-toggle="tab"
                        data-bs-target="#proses">Proses ⚙️</button></li>
                <li class="nav-item"><button class="nav-link bg-success text-white" data-bs-toggle="tab"
                        data-bs-target="#selesai">Selesai ✅</button></li>
                <li class="nav-item"><button class="nav-link bg-danger text-white" data-bs-toggle="tab"
                        data-bs-target="#tolak">Ditolak ❌</button></li>
            </ul>
        </div>

        {{-- ✅ Notifikasi --}}
        @if (session('success'))
            <div class="alert alert-success text-center rounded-pill shadow-sm fw-semibold">
                {{ session('success') }}
            </div>
        @endif

        {{-- 📋 Daftar Pengaduan --}}
        <div class="tab-content">

            {{-- 📋 All (gabungan semua status) --}}
            <div class="tab-pane fade show active" id="semua">
                @forelse ($pengaduan->sortByDesc('created_at') as $p)
                    <div
                        class="pengaduan-item d-flex align-items-start justify-content-between p-3 mb-3 shadow-sm rounded-4 bg-white">
                        <div class="d-flex align-items-start gap-3">
                            <img src="{{ $p->bukti ? asset('storage/' . $p->bukti) : asset('img/noimage.png') }}"
                                alt="bukti" class="rounded" style="width: 90px; height: 90px; object-fit: cover;">
                            <div>
                                <h6 class="fw-bold mb-1">{{ ucfirst($p->user->name) }}</h6>
                                <div class="small text-muted mb-1">{{ $p->tanggal }}</div>
                                <p class="mb-2 small text-secondary">{{ Str::limit($p->deskripsi, 80) }}</p>

                                <div class="bg-light p-2 rounded small">
                                    <strong>Tanggapan:</strong>
                                    @if ($p->tanggapan->count() > 0)
                                        <div>{{ $p->tanggapan->last()->isi }}</div>
                                    @else
                                        <span class="text-muted">Belum ada tanggapan</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Kanan: Status + Detail --}}
                        <div class="text-end" style="min-width: 160px;">
                            <span class="badge fs-6 mb-2 d-block py-2 w-100 text-white badge-{{ $p->status }}">
                                {{ ucfirst($p->status) }}
                            </span>

                            {{-- Tombol Detail hanya di All --}}
                            <a href="{{ route('admin.tanggapan.show', $p->id) }}"
                                class="btn btn-info btn-sm w-100 rounded-pill mt-2">detail 🔍</a>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-muted mt-4">tidak ada data pengaduan</p>
                @endforelse
            </div>

            {{-- Status Lainnya --}}
            @foreach (['pending' => 'Pending', 'proses' => 'Proses', 'selesai' => 'Selesai', 'tolak' => 'Ditolak'] as $status => $label)
                <div class="tab-pane fade" id="{{ $status }}">
                    @forelse ($pengaduan->where('status',$status)->sortByDesc('created_at') as $p)
                        <div
                            class="pengaduan-item d-flex align-items-start justify-content-between p-3 mb-3 shadow-sm rounded-4 bg-white">
                            <div class="d-flex align-items-start gap-3">
                                <img src="{{ $p->bukti ? asset('storage/' . $p->bukti) : asset('img/noimage.png') }}"
                                    alt="bukti" class="rounded" style="width: 90px; height: 90px; object-fit: cover;">
                                <div>
                                    <h6 class="fw-bold mb-1">{{ ucfirst($p->user->name) }}</h6>
                                    <div class="small text-muted mb-1">{{ $p->tanggal }}</div>
                                    <p class="mb-2 small text-secondary">{{ Str::limit($p->deskripsi, 80) }}</p>

                                    <div class="bg-light p-2 rounded small">
                                        <strong>Tanggapan:</strong>
                                        @if ($p->tanggapan->count() > 0)
                                            <div>{{ $p->tanggapan->last()->isi }}</div>
                                        @else
                                            <span class="text-muted">Belum ada tanggapan</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            {{-- Aksi kanan --}}
                            <div class="text-end" style="min-width: 160px;">
                                <span class="badge fs-6 mb-2 d-block py-2 w-100 text-white badge-{{ $status }}">
                                    {{ ucfirst($status) }}
                                </span>

                                @if ($status == 'pending')
                                    <form action="{{ route('admin.pengaduan.konfirmasi', $p->id) }}" method="POST"
                                        class="mb-1">@csrf
                                        <button class="btn btn-success btn-sm w-100 rounded-pill">konfirmasi ✅</button>
                                    </form>
                                    <form action="{{ route('admin.pengaduan.tolak', $p->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menolak pengaduan ini? 💔')">@csrf
                                        <button class="btn btn-danger btn-sm w-100 rounded-pill">tolak ❌</button>
                                    </form>
                                @elseif ($status == 'proses')
                                    @php $lastT = $p->tanggapan->last(); @endphp
                                    @if (!$lastT || $lastT->isi == 'Pengaduan Anda sedang diproses Admin.')
                                        <form action="{{ route('admin.tanggapan.store', $p->id) }}" method="POST">@csrf
                                            <textarea name="isi" class="form-control mb-2" placeholder="ketik tanggapan..." required></textarea>
                                            <button class="btn btn-primary btn-sm w-100 rounded-pill">kirim 💬</button>
                                        </form>
                                    @else
                                        <a href="{{ route('admin.tanggapan.edit', $lastT->id) }}"
                                            class="btn btn-warning btn-sm w-100 rounded-pill mb-2">edit ✏️ </a>
                                        <form action="{{ route('admin.pengaduan.selesai', $p->id) }}" method="POST"
                                            onsubmit="return confirm('Selesaikan pengaduan ini? ✅')">@csrf
                                            <button class="btn btn-success btn-sm w-100 rounded-pill">selesaikan ✅ </button>
                                        </form>
                                    @endif

                                @elseif ($status == 'selesai')
                                    <span class="text-success fw-semibold">pengaduan selesai ✅</span>
                                @elseif ($status == 'tolak')
                                    <span class="text-danger fw-semibold">pengaduan ditolak ❌</span>
                                @endif
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-muted mt-4">tidak ada data {{ $label }} 😢</p>
                    @endforelse
                </div>
            @endforeach
        </div>
    </div>

    {{-- 💅 Style --}}
    <style>
        .status-tabs .nav-link {
            border: none;
            border-radius: 20px;
            font-weight: 600;
            margin-right: 5px;
            padding: 6px 14px;
            transition: 0.3s;
        }

        .badge-pending {
            background-color: #ffc107;
        }

        /* kuning */
        .badge-proses {
            background-color: #0dcaf0;
        }

        /* biru muda */
        .badge-selesai {
            background-color: #28a745;
        }

        /* hijau */
        .badge-tolak {
            background-color: #dc3545;
        }

        /* merah */
        .pengaduan-item {
            transition: 0.3s ease;
        }
    </style>

   <script>
document.addEventListener('DOMContentLoaded', function () {
    const params = new URLSearchParams(window.location.search);
    const tabParam = params.get('tab');

    if (tabParam) {
        // hapus semua active/show
        document.querySelectorAll('.tab-pane').forEach(el => el.classList.remove('show','active'));
        document.querySelectorAll('.status-tabs .nav-link').forEach(el => el.classList.remove('active'));

        // aktifkan tab sesuai param
        const tabPane = document.getElementById(tabParam);
        const tabButton = document.querySelector(`[data-bs-target="#${tabParam}"]`);
        if(tabPane && tabButton){
            tabPane.classList.add('show','active');
            tabButton.classList.add('active');
        }
    }

    // setiap klik tab → update query param di URL
    document.querySelectorAll('.status-tabs .nav-link').forEach(link => {
        link.addEventListener('click', function() {
            const target = this.getAttribute('data-bs-target').substring(1);
            const url = new URL(window.location);
            url.searchParams.set('tab', target);
            window.history.replaceState(null, '', url); // ganti URL tanpa reload
        });
    });
});
</script>
@endsection
