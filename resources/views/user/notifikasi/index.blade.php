@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4">🔔 Notifikasi</h3>

    <ul class="list-group">
        @forelse ($notifikasi as $n)
            <li class="list-group-item d-flex justify-content-between align-items-center
                {{ $n->is_read ? '' : 'fw-bold' }}">
                <div>
                    {{ $n->pesan }}
                    <br>
                    <small class="text-muted">{{ $n->created_at->diffForHumans() }}</small>
                </div>
                @if (!$n->is_read)
                    <form action="{{ route('user.notifikasi.read', $n->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button class="btn btn-sm btn-outline-primary">Tandai Dibaca</button>
                    </form>
                @endif
            </li>
        @empty
            <li class="list-group-item text-center text-muted">Belum ada notifikasi</li>
        @endforelse
    </ul>
</div>
@endsection