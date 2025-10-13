@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="container">
        <h2 class="mb-4">📊 Dashboard Admin</h2>
        <p>Selamat datang kembali, <b>Admin</b>! Di sini Anda dapat mengelola pengaduan masyarakat.</p>

        {{-- Ringkasan Kartu --}}
        <div class="row mt-4">
            <!-- TOTAL KATEGORI -->
            <div class="col-md-3">
               <div class="card text-white bg-warning mb-3">
                    <div class="card-body text-center">
                        <h5 class="card-title">Total Kategori 🗂️</h5>
                        <p class="card-text fs-4">{{ $totalKategori }}</p>
                    </div>
                </div>
            </div>

            <!-- TOTAL PENGADUAN -->
            <div class="col-md-3">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-body text-center">
                        <h5 class="card-title">Total Pengaduan 📢</h5>
                        <p class="card-text fs-4">{{ $totalPengaduan }}</p>
                    </div>
                </div>
            </div>

            <!-- PENDING -->
            <div class="col-md-2">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-body text-center">
                        <h5 class="card-title">Pending⏳</h5>
                        <p class="card-text fs-4">{{ $pengaduanPending }}</p>
                    </div>
                </div>
            </div>

            <!-- PROSES -->
            <div class="col-md-2">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-body text-center">
                        <h5 class="card-title">Process🔄</h5>
                        <p class="card-text fs-4">{{ $pengaduanProses }}</p>
                    </div>
                </div>
            </div>

            <!-- SELESAI -->
            <div class="col-md-2">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-body text-center">
                        <h5 class="card-title">Cmpletd✅</h5>
                        <p class="card-text fs-4">{{ $pengaduanSelesai }}</p>
                    </div>
                </div>
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
