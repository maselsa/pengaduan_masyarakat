@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Edit Tanggapan 📩</h3>

        <form action="{{ route('admin.tanggapan.update', $tanggapan->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Hidden input untuk tab aktif --}}
            <input type="hidden" name="tab" value="{{ request('tab', 'proses') }}">

            <div class="mb-3">
                <label for="isi" class="form-label">Isi Tanggapan</label>
                <textarea name="isi" id="isi" rows="5" class="form-control" required>{{ old('isi', $tanggapan->isi) }}</textarea>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">💾 update</button>
                <a href="{{ route('admin.tanggapan.index', ['tab' => request('tab', 'proses')]) }}"
                    class="btn btn-secondary">⬅️ back</a>
            </div>
        </form>
    </div>
@endsection

