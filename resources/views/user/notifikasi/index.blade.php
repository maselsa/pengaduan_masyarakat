@extends('layouts.app')

@section('content')
    <div class="container">
        <h3 class="mb-4">🔔 Notifikasi</h3>

        <ul class="list-group">
            @forelse ($notifikasi as $n)
                <li class="list-group-item {{ $n->status == 'belum_dibaca' ? 'fw-bold' : '' }}">
                    {{ $n->pesan }}
                    <span class="text-muted d-block small">{{ $n->created_at->diffForHumans() }}</span>
                </li>
            @empty
                <li class="list-group-item text-center">Belum ada notifikasi</li>
            @endforelse
        </ul>
    </div>
@endsection
