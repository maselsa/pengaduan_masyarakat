@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="container">

        {{-- Header Dashboard --}}
        <div class="text-center p-4 mb-4 rounded shadow-sm">
            <h1>🌷 Welcome to the Public Complaint System 🌷</h1>

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

        <div class="row mt-4">
            <!-- TOTAL -->
            <div class="col-md-3">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-body text-center">
                        <h5 class="card-title">Total 📋</h5>
                        <p class="card-text fs-4">{{ $total }}</p>
                    </div>
                </div>
            </div>

            <!-- PENDING -->
            <div class="col-md-3">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-body text-center">
                        <h5 class="card-title">Pending ⏳</h5>
                        <p class="card-text fs-4">{{ $pending }}</p>
                    </div>
                </div>
            </div>

            <!-- PROSES -->
            <div class="col-md-3">
                <div class="card text-white bg-secondary mb-3">
                    <div class="card-body text-center">
                        <h5 class="card-title">In Process 🔄</h5>
                        <p class="card-text fs-4">{{ $proses }}</p>
                    </div>
                </div>
            </div>

            <!-- SELESAI -->
            <div class="col-md-3">
                <div class="card text-white bg-success mb-3">
                    <div class="card-body text-center">
                        <h5 class="card-title">Completed ✅</h5>
                        <p class="card-text fs-4">{{ $selesai }}</p>
                    </div>
                </div>
            </div>
        </div>


        {{-- Statistik Grafik Pengaduan --}}
        <div class="card mt-5 shadow border-0 rounded-4">
            <div class="card-body">
                <h3 class="text-center mb-4">📊 Complaint Statistics</h3>
                <canvas id="complaintChart" height="120"></canvas>
            </div>
        </div>

        {{-- Script Chart.js --}}
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const ctx = document.getElementById('complaintChart');

            new Chart(ctx, {
                type: 'bar', // pakai bar chart
                data: {
                    labels: ['Pending ⏳', 'In Process 🔄', 'Completed ✅'],
                    datasets: [{
                        label: 'Jumlah Pengaduan',
                        data: [
                            {{ \App\Models\Pengaduan::where('email', auth()->user()->email)->where('status', 'pending')->count() }},
                            {{ \App\Models\Pengaduan::where('email', auth()->user()->email)->where('status', 'proses')->count() }},
                            {{ \App\Models\Pengaduan::where('email', auth()->user()->email)->where('status', 'selesai')->count() }}
                        ],
                        backgroundColor: [
                            '#ff69b4', // Pending
                            '#ffb6c1', // In Process
                            '#c71585' // Completed
                        ],
                        borderWidth: 1,
                        borderColor: '#fff'
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false // legend disembunyikan
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
    </div>
@endsection
