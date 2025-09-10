@extends('layouts.app')

@section('content')
    <div class="vh-100 d-flex justify-content-center align-items-center"
        style="background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%);">

        <div class="card shadow-lg p-4" style="width: 400px; border-radius: 25px;">
            <h2 class="text-center mb-4" style="color:#d63384; font-weight:bold;">
                🍓 Register 🍓
            </h2>

            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Lengkap</label>
                    <input id="name" type="text" class="form-control rounded-pill" name="name" required
                        autofocus>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input id="email" type="email" class="form-control rounded-pill" name="email" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input id="password" type="password" class="form-control rounded-pill" name="password" required>
                </div>

                <div class="mb-3">
                    <label for="password-confirm" class="form-label">Konfirmasi Password</label>
                    <input id="password-confirm" type="password" class="form-control rounded-pill"
                        name="password_confirmation" required>
                </div>

                <button type="submit" class="btn w-100 text-white"
                    style="background-color:#ff4d6d; border-radius:50px; font-weight:bold;">
                    Register
                </button>
            </form>

            <p class="text-center mt-3">
                Sudah punya akun? <a href="{{ route('login') }}" style="color:#d63384; font-weight:bold;">Login 💖</a>
            </p>
        </div>
    </div>
@endsection
