@extends('layouts.app')

@section('title', 'Dashboard Masyarakat')

@section('content')
    <div class="container">

        {{-- Header Dashboard --}}
        <div class="text-center p-4 mb-4 rounded shadow-sm" style="background: #fff0f6;">
            <h1 class="fw-bold" style="color:#d63384;">🌷 Welcome to the Public Complaint System,
                {{ auth()->user()->name }} 🌷</h1>

            {{-- Tombol Buat Pengaduan (khusus role user) --}}
            @if (auth()->user()->role == 'user')
                <a href="{{ route('user.pengaduan.create') }}" class="btn mt-3 px-4 py-2"
                    style="background: linear-gradient(135deg, #ff1493, #ec7ac2); 
                        color: white; 
                        font-weight: bold; 
                        border-radius: 25px; 
                        font-size: 18px;">
                    add complaint 💌
                </a>
            @endif
        </div>

        {{-- Banner Foto --}}
        <div class="mb-4">
            <img src="{{ asset('assets/img/wc.jpeg') }}" class="img-fluid w-100 shadow-lg"
                style="max-height: 500px; object-fit: border-radius: 50px;">
        </div>

        <div class="mb-4">
            <img src="{{ asset('assets/img/well.jpeg') }}" class="img-fluid w-100 shadow-lg"
                style="max-height: 500px; object-fit: border-radius: 50px;">
        </div>


        {{-- Syarat & Ketentuan --}}
        <div class="card mt-4 shadow-lg border-0 rounded-4" style="background: linear-gradient(135deg, #ffe0f0, #ffc7de);">
            <div class="card-body">
                <h3 class="mb-4  fw-bold" style="color:#d63384;">
                    ⚠️ Syarat & Ketentuan Pengaduan ⚠️
                </h3>
                <div class="row g-4">

                    {{-- Identitas Pelapor --}}
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 shadow-sm h-100"
                            style="background:rgb(255, 210, 235); border-left:6px solid #d63384; transition: all .3s;">
                            <h5 class="fw-bold mb-3" style="color:#d63384;">👤 Identitas Pelapor</h5>
                            <ul class="list-unstyled mb-0">
                                <li>📢 Akun harus terdaftar di sistem pengaduan.</li>
                                <li>🪪 Data identitas harus sesuai dan jelas.</li>
                                <li>🔒 Identitas pelapor dijamin kerahasiaannya.</li>
                            </ul>
                        </div>
                    </div>

                    {{-- Isi Laporan --}}
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 shadow-sm h-100"
                            style="background:rgb(255, 210, 235); border-left:6px solid #d63384; transition: all .3s;">
                            <h5 class="fw-bold mb-3" style="color:#d63384;">📝 Isi Laporan</h5>
                            <ul class="list-unstyled mb-0">
                                <li>✍️ Pengaduan harus jelas dan sopan.</li>
                                <li>📷 Diwajibkan mengirimkan bukti foto.</li>
                                <li>📖 Kronologi kejadian harus lengkap & runtut.</li>
                            </ul>
                        </div>
                    </div>

                    {{-- Proses & Tindak Lanjut --}}
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 shadow-sm h-100"
                            style="background:rgb(255, 210, 235); border-left:6px solid #d63384; transition: all .3s;">
                            <h5 class="fw-bold mb-3" style="color:#d63384;">⚖️ Proses & Tindak Lanjut</h5>
                            <ul class="list-unstyled mb-0">
                                <li>⏳ Verifikasi pengaduan max 3 hari kerja.</b></li>
                                <li>🔄 Status: Pending → Proses → Selesai.</li>
                                <li>📢 Pelapor mendapat notifikasi otomatis.</li>
                            </ul>
                        </div>
                    </div>

                    {{-- Larangan & Ketentuan --}}
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 shadow-sm h-100"
                            style="background:rgb(255, 210, 235); border-left:6px solid #d63384; transition: all .3s;">
                            <h5 class="fw-bold mb-3" style="color:#d63384;">🚫 Larangan & Ketentuan</h5>
                            <ul class="list-unstyled mb-0">
                                <li>❌ Dilarang mengirimkan pengaduan yang hoax.</li>
                                <li>⚠️ Pengaduan yang tidak jelas akan ditolak.</li>
                                <li>🔁 Dilarang menggandakan pengaduan yang sama.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        {{-- Statistik Card --}}
        <div class="row row-cols-1 row-cols-md-5 g-3 mt-4">
            <!-- TOTAL -->
            <div class="col">
                <div class="card text-white bg-primary shadow h-105 rounded-4">
                    <div class="card-body text-center">
                        <h5 class="card-title">Total 📋</h5>
                        <p class="card-text fs-3 fw-bold">{{ $total }}</p>
                    </div>
                </div>
            </div>
            <!-- PENDING -->
            <div class="col">
                <div class="card text-dark bg-warning shadow h-105 rounded-4">
                    <div class="card-body text-center">
                        <h5 class="card-title">Pending ⏳</h5>
                        <p class="card-text fs-3 fw-bold">{{ $pending }}</p>
                    </div>
                </div>
            </div>
            <!-- PROSES -->
            <div class="col">
                <div class="card text-white bg-secondary shadow h-105 rounded-4">
                    <div class="card-body text-center">
                        <h5 class="card-title">In Process 🔄</h5>
                        <p class="card-text fs-3 fw-bold">{{ $proses }}</p>
                    </div>
                </div>
            </div>
            <!-- SELESAI -->
            <div class="col">
                <div class="card text-white bg-success shadow h-105 rounded-4">
                    <div class="card-body text-center">
                        <h5 class="card-title">Completed ✅</h5>
                        <p class="card-text fs-3 fw-bold">{{ $selesai }}</p>
                    </div>
                </div>
            </div>
            <!-- TOLAK -->
            <div class="col">
                <div class="card text-white bg-danger shadow h-105 rounded-4">
                    <div class="card-body text-center">
                        <h5 class="card-title">Tolak ❌</h5>
                        <p class="card-text fs-3 fw-bold">{{ $tolak }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Notifikasi Terbaru --}}
        <div class="card mt-4 shadow-lg border-0 rounded-4" style="background: linear-gradient(135deg, #ffe0f0, #ffc7de);">
            <div class="card-body">
                <h3 class="mb-3  fw-bold" style="color:#d63384;">
                    🔔 Notifikasi Terbaru
                </h3>
                <div class="row g-4">
                    <ul class="list-group">
                        @foreach (\App\Models\Notifikasi::where('user_id', auth()->id())->latest()->take(6)->get() as $notif)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $notif->pesan }}
                                <span class="badge"
                                    style="background:#ff1493;">{{ $notif->created_at->diffForHumans() }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        {{-- Riwayat Pengaduan Terbaru --}}
        <div class="card mt-4 shadow-lg border-0 rounded-4" style="background: linear-gradient(135deg, #ffe0f0, #ffc7de);">
            <div class="card-body">
                <h3 class="mb-3  fw-bold" style="color:#d63384;">
                    🕒 Riwayat Pengaduan Terbaru
                </h3>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Pengaduan</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (\App\Models\Pengaduan::where('user_id', auth()->id())->latest()->take(5)->get() as $i => $p)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ \Illuminate\Support\Str::limit($p->deskripsi, 40) }}</td>
                                <td>
                                    <span
                                        class="badge 
                                        @if ($p->status == 'pending') bg-warning 
                                        @elseif($p->status == 'proses') bg-info 
                                        @elseif($p->status == 'selesai') bg-success 
                                        @else bg-danger @endif">
                                        {{ ucfirst($p->status) }}
                                    </span>
                                </td>
                                <td>{{ $p->created_at->format('d M Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Statistik Grafik Pengaduan --}}
        <div class="card mt-4 shadow-lg border-0 rounded-4" style="background: linear-gradient(135deg, #ffe0f0, #ffc7de);">
            <div class="card-body">
                <h3 class="mb-3  fw-bold" style="color:#d63384;">
                    📊 Complaint Statistics
                </h3>
                <canvas id="complaintChart" height="120"></canvas>
            </div>
        </div>

         {{-- foto thank you and goodbye --}}
        <div class="mb-4">
            <img src="{{ asset('assets/img/ty.jpeg') }}" class="img-fluid w-100 shadow-lg"
                style="max-height: 500px; object-fit: border-radius: 50px;">
        </div>

        <div class="mb-4">
            <img src="{{ asset('assets/img/gb.jpeg') }}" class="img-fluid w-100 shadow-lg"
                style="max-height: 500px; object-fit: border-radius: 50px;">
        </div>

        {{-- Script Chart.js --}}
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const ctx = document.getElementById('complaintChart');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Pending ⏳', 'In Process 🔄', 'Completed ✅', 'Tolak ❌'],
                    datasets: [{
                        label: 'Jumlah Pengaduan',
                        data: [
                            {{ \App\Models\Pengaduan::where('user_id', auth()->id())->where('status', 'pending')->count() }},
                            {{ \App\Models\Pengaduan::where('user_id', auth()->id())->where('status', 'proses')->count() }},
                            {{ \App\Models\Pengaduan::where('user_id', auth()->id())->where('status', 'selesai')->count() }},
                            {{ \App\Models\Pengaduan::where('user_id', auth()->id())->where('status', 'tolak')->count() }}
                        ],
                        backgroundColor: [
                            '#ffe4e9', '#ffccd5', '#ffb3c6', '#ff8fab'
                        ],
                        borderWidth: 1,
                        borderColor: '#fff'
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1,
                                color: '#d63384',
                                font: {
                                    size: 14,
                                    weight: 'bold'
                                }
                            }
                        },
                        x: {
                            ticks: {
                                color: '#d63384',
                                font: {
                                    size: 14,
                                    weight: 'bold'
                                }
                            }
                        }
                    }
                }
            });
        </script>
    @endsection
