@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>📝 Edit Kategori</h3>

        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Nama Kategori</label>
                <input type="text" name="name" class="form-control" id="name"
                    value="{{ old('name', $category->name) }}" required>
                @error('name')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">💾 update</button>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">⬅️ back</a>
        </form>
    </div>
@endsection
