@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="container">
        <h2 class="mb-4">📊 Dashboard Admin</h2>
        <p>Selamat datang kembali, <b>Admin</b>! Di sini Anda dapat mengelola pengaduan masyarakat.</p>

        {{-- Data Masyarakat Terbaru --}}
        <div class="card mt-4 shadow">
            <div class="card-body">
                <h5 class="card-title">👥 Data Masyarakat Terbaru</h5>
                <table class="table table-hover align-middle">
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
                        <h5 class="card-title">Process 🔄</h5>
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
        <div class="card mt-4 shadow">
            <div class="card-body">
                <h5 class="card-title">🕒 Pengaduan Terbaru</h5>
                <table class="table table-hover align-middle">
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
                                @elseif($p->status == 'proses') bg-secondary 
                                @elseif($p->status == 'selesai') bg-success 
                                @elseif($p->status == 'tolak') bg-danger @endif">
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

        {{-- Grafik Pengaduan --}}
        <div class="card mt-5">
            <div class="card-body">
                <h5 class="card-title">📈 Grafik Pengaduan per Kategori</h5>
                <canvas id="pengaduanChart" height="120"></canvas>
            </div>
        </div>
    </div>
@endsection

{{-- Chart.js --}}
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('pengaduanChart').getContext('2d');
        const pengaduanChart = new Chart(ctx, {
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
    </script>



@endsection
