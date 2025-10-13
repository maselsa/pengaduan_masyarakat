@extends('layouts.app')

@section('title', 'Tanggapan Pengaduan Masyarakat')

@section('content')
    <div class="container">
        <h3 class="mb-4">Tanggapan Pengaduan 📩</h3>

        {{-- Tab Status Menu --}}
        <ul class="nav status-tabs flex-wrap mb-4">
            <li class="nav-item"><button class="nav-link active bg-secondary text-white" data-bs-toggle="tab"
                    data-bs-target="#semua">All 📋</button></li>
            <li class="nav-item"><button class="nav-link bg-warning text-dark" data-bs-toggle="tab"
                    data-bs-target="#pending">Pending ⏳</button></li>
            <li class="nav-item"><button class="nav-link bg-info text-white" data-bs-toggle="tab"
                    data-bs-target="#proses">Proses ⚙️</button></li>
            <li class="nav-item"><button class="nav-link bg-success text-white" data-bs-toggle="tab"
                    data-bs-target="#selesai">Selesai ✅</button></li>
            <li class="nav-item"><button class="nav-link bg-danger text-white" data-bs-toggle="tab"
                    data-bs-target="#tolak">Ditolak ❌</button></li>
        </ul>

        {{-- Notifikasi --}}
        @if (session('success'))
            <div class="alert alert-success text-center rounded-pill shadow-sm fw-semibold">
                {{ session('success') }}
            </div>
        @endif

        {{-- Tab Content --}}
        <div class="tab-content">
            {{-- All --}}
            <div class="tab-pane fade show active" id="semua">
                @forelse($pengaduan->sortByDesc('created_at') as $p)
                    <div class="pengaduan-item d-flex justify-content-between p-3 mb-3 shadow-sm rounded-4 bg-white">
                        <div class="d-flex align-items-start gap-3">
                            {{-- Gambar + Deskripsi --}}
                            <img src="{{ $p->bukti ? asset('storage/' . $p->bukti) : asset('img/noimage.png') }}"
                                alt="bukti" class="rounded" style="width:90px; height:90px; object-fit:cover;">
                            <div>
                                <h6 class="fw-bold mb-1">{{ ucfirst($p->user->name) }}</h6>
                                <div class="small text-muted mb-1">{{ $p->tanggal }}</div>
                                <p class="mb-2 small text-secondary">{{ Str::limit($p->deskripsi, 80) }}</p>

                                <div class="bg-light p-2 rounded small">
                                    <strong>Tanggapan:</strong>
                                    @if ($p->tanggapan->count() > 0)
                                        {{ $p->tanggapan->last()->isi }}
                                    @else
                                        <span class="text-muted">Belum ada tanggapan.</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- All Kanan: Status + Detail --}}
                        <div class="text-end d-flex flex-column justify-content-between" style="min-width:120px;">
                            <span class="badge fs-6 mb-2 py-2 text-white badge-{{ $p->status }}">
                                {{ ucfirst($p->status) }}
                            </span>
                            <a href="{{ route('user.tanggapan.show', $p->id) }}"
                                class="btn btn-info btn-sm rounded-pill w-100">detail 🔍</a>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-muted mt-4">Belum ada pengaduan.</p>
                @endforelse
            </div>

            {{-- Per Status --}}
            @foreach (['pending' => 'Pending', 'proses' => 'Proses', 'selesai' => 'Selesai', 'tolak' => 'Ditolak'] as $status => $label)
                <div class="tab-pane fade" id="{{ $status }}">
                    @forelse($pengaduan->where('status',$status)->sortByDesc('created_at') as $p)
                        <div class="pengaduan-item d-flex justify-content-between p-3 mb-3 shadow-sm rounded-4 bg-white">
                            <div class="d-flex align-items-start gap-3">
                                <img src="{{ $p->bukti ? asset('storage/' . $p->bukti) : asset('img/noimage.png') }}"
                                    alt="bukti" class="rounded" style="width:90px; height:90px; object-fit:cover;">
                                <div>
                                    <h6 class="fw-bold mb-1">{{ ucfirst($p->user->name) }}</h6>
                                    <div class="small text-muted mb-1">{{ $p->tanggal }}</div>
                                    <p class="mb-2 small text-secondary">{{ Str::limit($p->deskripsi, 80) }}</p>

                                    <div class="bg-light p-2 rounded small">
                                        <strong>Tanggapan:</strong>
                                        @if ($p->tanggapan->count() > 0)
                                            {{ $p->tanggapan->last()->isi }}
                                        @else
                                            <span class="text-muted">Belum ada tanggapan.</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="text-end d-flex flex-column justify-content-between" style="min-width:120px;">
                                <span class="badge fs-6 mb-2 py-2 text-white badge-{{ $status }}">
                                    {{ ucfirst($status) }}
                                </span>
                                <a href="{{ route('user.tanggapan.show', $p->id) }}"
                                    class="btn btn-info btn-sm rounded-pill w-100">detail 🔍</a>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-muted mt-4">Tidak ada data {{ $label }} </p>
                    @endforelse
                </div>
            @endforeach
        </div>
    </div>

    {{-- Style --}}
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

        .badge-proses {
            background-color: #0dcaf0;
        }

        .badge-selesai {
            background-color: #28a745;
        }

        .badge-tolak {
            background-color: #dc3545;
        }

        .pengaduan-item {
            transition: 0.3s ease;
        }
    </style>

    {{-- Script tab --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const params = new URLSearchParams(window.location.search);
            const tabParam = params.get('tab');

            if (tabParam) {
                document.querySelectorAll('.tab-pane').forEach(el => el.classList.remove('show', 'active'));
                document.querySelectorAll('.status-tabs .nav-link').forEach(el => el.classList.remove('active'));
                const tabPane = document.getElementById(tabParam);
                const tabButton = document.querySelector(`[data-bs-target="#${tabParam}"]`);
                if (tabPane && tabButton) {
                    tabPane.classList.add('show', 'active');
                    tabButton.classList.add('active');
                }
            }

            document.querySelectorAll('.status-tabs .nav-link').forEach(link => {
                link.addEventListener('click', function() {
                    const target = this.getAttribute('data-bs-target').substring(1);
                    const url = new URL(window.location);
                    url.searchParams.set('tab', target);
                    window.history.replaceState(null, '', url);
                });
            });
        });
    </script>
@endsection
