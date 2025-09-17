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
                    style="background: linear-gradient(135deg, #ff1493, #f576c6); 
                 color: white; 
                 font-weight: bold; 
                 border-radius: 25px; 
                 font-size: 18px;">
                    add complaint 💌
                </a>
            @endif
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
                            {{ \App\Models\Pengaduan::where('email', auth()->user()->email)->where('status','pending')->count() }},
                            {{ \App\Models\Pengaduan::where('email', auth()->user()->email)->where('status','proses')->count() }},
                            {{ \App\Models\Pengaduan::where('email', auth()->user()->email)->where('status','selesai')->count() }}
                        ],
                        backgroundColor: [
                            '#ff69b4', // Pending
                            '#ffb6c1', // In Process
                            '#c71585'  // Completed
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
