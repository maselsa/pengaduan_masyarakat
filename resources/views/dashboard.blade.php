@extends('layouts.app')

@section('content')
<div class="alert alert-success">
    {{ session('success') }}
</div>
<h3>Selamat Datang di Sistem Pengaduan Masyarakat</h3>
<p>Silakan ajukan atau kelola pengaduan sesuai hak akses Anda.</p>
@endsection
