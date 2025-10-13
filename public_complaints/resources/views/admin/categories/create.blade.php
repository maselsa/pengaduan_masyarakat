@extends('layouts.app')

@section('content')
<div class="container">
    <h3>🗂️ Add Kategori</h3>

    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama Kategori</label>
            <input type="text" name="name" class="form-control" id="name" required>
            @error('name')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">📥 save</button>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">⬅️ back</a>
    </form>
</div>
@endsection
