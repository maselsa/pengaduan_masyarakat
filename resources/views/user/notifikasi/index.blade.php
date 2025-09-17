@extends('layouts.app')

@section('content')
    <div class="container">
        <h3 class="mb-4">🔔 Notifikasi</h3>

        <ul class="list-group">
            @forelse ($notifikasi as $n)
                <li class="list-group-item {{ $n->read_at ? '' : 'fw-bold' }}">
                    {{ $n->data['message'] ?? 'Tidak ada pesan' }}
                    <span class="text-muted d-block small">
                        {{ $n->created_at->diffForHumans() }}
                    </span>
                </li>
            @empty
                <li class="list-group-item text-center text-muted">Belum ada notifikasi</li>
            @endforelse
        </ul>
    </div>
@endsection
