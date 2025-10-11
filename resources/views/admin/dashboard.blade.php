@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="container">

        {{-- Header Dashboard --}}
        <div class="text-center p-4 mb-4 rounded shadow-sm" style="background: #fff0f6;">
            <h1 class="fw-bold" style="color:#d63384;">🌷 Welcome back, Admin! 🌷</h1>
        </div>

        <div class="mb-4">
            <img src="{{ asset('assets/img/wc.jpeg') }}" class="img-fluid w-100 shadow-lg"
                style="max-height: 500px; object-fit: border-radius: 50px;">
        </div>

        <div class="mb-4">
            <img src="{{ asset('assets/img/well.jpeg') }}" class="img-fluid w-100 shadow-lg"
                style="max-height: 500px; object-fit: border-radius: 50px;">
        </div>

        {{-- Data Masyarakat Terbaru --}}
        <div class="card mt-4 shadow-lg border-0 rounded-4" style="background: linear-gradient(135deg, #ffe0f0, #ffc7de);">
            <div class="card-body">
                <h3 class="mb-3  fw-bold" style="color:#d63384;">
                    👥 Data Masyarakat Terbaru
                </h3>
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Foto</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Tanggal Daftar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($masyarakatTerbaru as $key => $user)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    @if ($user->foto)
                                        <img src="{{ asset('storage/' . $user->foto) }}" alt="Foto Profil" width="40"
                                            height="40" class="rounded-circle">
                                    @else
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=ff9be6&color=fff"
                                            alt="Foto Profil" width="40" height="40" class="rounded-circle">
                                    @endif
                                </td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at->format('d M Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Galeri Masyarakat Terbaru --}}
        <div class="card mt-5 border-0 shadow-sm rounded-4" style="background: linear-gradient(135deg, #fff5f8, #ffe9f2);">
            <div class="card-body">
                <h3 class="fw-bold mb-4" style="color:#c2185b;">
                    👥 Galeri Masyarakat Terbaru
                </h3>

                <div class="row g-4">
                    @foreach ($masyarakatTerbaru as $user)
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                            <div class="text-center shadow-sm border-0 rounded-4 p-3 h-100"
                                style="background:white; border:1px solid #f8bbd0; transition:0.3s;">

                                <div class="profile-img mx-auto mb-3">
                                    @if ($user->foto)
                                        <img src="{{ asset('storage/' . $user->foto) }}" alt="{{ $user->name }}"
                                            class="img-fluid rounded-4">
                                    @else
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=f48fb1&color=fff&size=400"
                                            alt="{{ $user->name }}" class="img-fluid rounded-4">
                                    @endif
                                </div>

                                <h5 class="fw-semibold text-dark mb-0">{{ ucfirst($user->name) }}</h5>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <style>
            .profile-img {
                width: 100%;
                aspect-ratio: 1 / 1;
                overflow: hidden;
                border-radius: 16px;
            }

            .profile-img img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                transition: transform 0.4s ease;
            }
        </style>

        {{-- Ringkasan Kartu --}}
        <div class="row mt-4">
            <!-- TOTAL KATEGORI -->
            <div class="col-md-6">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-body text-center">
                        <h5 class="card-title">Total Kategori 🗂️</h5>
                        <p class="card-text fs-2">{{ $totalKategori }}</p>
                    </div>
                </div>
            </div>

            <!-- TOTAL PENGADUAN -->
            <div class="col-md-6">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-body text-center">
                        <h5 class="card-title">Total Pengaduan 📢</h5>
                        <p class="card-text fs-2">{{ $totalPengaduan }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- PENDING -->
            <div class="col-md-3">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-body text-center">
                        <h5 class="card-title">Pending ⏳</h5>
                        <p class="card-text fs-4">{{ $pengaduanPending }}</p>
                    </div>
                </div>
            </div>

            <!-- PROSES -->
            <div class="col-md-3">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-body text-center">
                        <h5 class="card-title">Proses 🔄</h5>
                        <p class="card-text fs-4">{{ $pengaduanProses }}</p>
                    </div>
                </div>
            </div>

            <!-- SELESAI -->
            <div class="col-md-3">
                <div class="card text-white bg-success mb-3">
                    <div class="card-body text-center">
                        <h5 class="card-title">Completed ✅</h5>
                        <p class="card-text fs-4">{{ $pengaduanSelesai }}</p>
                    </div>
                </div>
            </div>

            <!-- TOLAK -->
            <div class="col-md-3">
                <div class="card text-white bg-danger mb-3">
                    <div class="card-body text-center">
                        <h5 class="card-title">Tolak ❌</h5>
                        <p class="card-text fs-4">{{ $pengaduanTolak }}</p>
                    </div>
                </div>
            </div>
        </div>


        {{-- Tabel Pengaduan Terbaru --}}
        <div class="card mt-4 shadow-lg border-0 rounded-4" style="background: linear-gradient(135deg, #ffe0f0, #ffc7de);">
            <div class="card-body">
                <h3 class="mb-3  fw-bold" style="color:#d63384;">
                    🕒 Data Pengaduan Terbaru
                </h3>
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Pengaduan</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pengaduanTerbaru as $key => $p)
                            <tr>
                                <td>{{ $key + 1 }}</td>
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

        {{-- Grafik Pengaduan per Kategori --}}
        <div class="card mt-4 shadow-lg border-0 rounded-4" style="background: linear-gradient(135deg, #ffe0f0, #ffc7de);">
            <div class="card-body">
                <h3 class="mb-3  fw-bold" style="color:#d63384;">
                    📊 Complaint Graph per Category
                </h3>
                <canvas id="pengaduanChart" height="120"></canvas>
            </div>
        </div>

        {{-- Grafik Pengaduan per Status --}}
        <div class="card mt-4 shadow-lg border-0 rounded-4" style="background: linear-gradient(135deg, #ffe0f0, #ffc7de);">
            <div class="card-body">
                <h3 class="mb-3  fw-bold" style="color:#d63384;">
                    📊 Complaint Graph per Status
                </h3>
                <canvas id="complaintChart" height="120"></canvas>
            </div>
        </div>

        <div class="mb-4">
            <img src="{{ asset('assets/img/ty.jpeg') }}" class="img-fluid w-100 shadow-lg"
                style="max-height: 500px; object-fit: border-radius: 50px;">
        </div>

        <div class="mb-4">
            <img src="{{ asset('assets/img/gb.jpeg') }}" class="img-fluid w-100 shadow-lg"
                style="max-height: 500px; object-fit: border-radius: 50px;">
        </div>

    @endsection

    {{-- Chart.js --}}
    @section('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            // === GRAFIK PENGADUAN PER KATEGORI ===
            const ctxKategori = document.getElementById('pengaduanChart').getContext('2d');
            new Chart(ctxKategori, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($categoryNames) !!},
                    datasets: [{
                        label: 'Jumlah Pengaduan',
                        data: {!! json_encode($pengaduanCounts) !!},
                        backgroundColor: 'rgba(255, 99, 132, 0.6)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            }
                        }
                    }
                }
            });

            // === GRAFIK PENGADUAN PER STATUS ===
            const ctxComplaint = document.getElementById('complaintChart').getContext('2d');
            new Chart(ctxComplaint, {
                type: 'bar',
                data: {
                    labels: ['Pending ⏳', 'In Process 🔄', 'Completed ✅', 'Tolak ❌'],
                    datasets: [{
                        label: 'Jumlah Pengaduan',
                        data: [
                            {{ \App\Models\Pengaduan::where('status', 'pending')->count() }},
                            {{ \App\Models\Pengaduan::where('status', 'proses')->count() }},
                            {{ \App\Models\Pengaduan::where('status', 'selesai')->count() }},
                            {{ \App\Models\Pengaduan::where('status', 'tolak')->count() }}
                        ],
                        backgroundColor: ['#ffe4e9', '#ffccd5', '#ffb3c6', '#ff8fab'],
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
