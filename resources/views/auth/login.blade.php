@extends('layouts.app')

@section('content')
    <div class="vh-100 d-flex justify-content-center align-items-center"
        style="min-height: 100vh; background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%);">
        <style>
            body

            /* 🌸 Emoji Rain */
            .emoji {
                position: fixed;
                top: -50px;
                font-size: 30px;
                pointer-events: none;
                animation: fall linear forwards;
            }

            @keyframes fall {
                to {
                    transform: translateY(100vh) rotate(360deg);
                    opacity: 0;
                }
            }
        </style>
        <script>
            // 🌸 Emoji Rain ringan
            document.addEventListener("DOMContentLoaded", function() {
                const emojis = [ "🍓"];

                function createEmoji() {
                    const emoji = document.createElement("div");
                    emoji.className = "emoji";
                    emoji.textContent = emojis[Math.floor(Math.random() * emojis.length)];
                    emoji.style.left = Math.random() * 100 + "vw";
                    emoji.style.animationDuration = (3 + Math.random() * 3) + "s";
                    document.body.appendChild(emoji);
                    setTimeout(() => emoji.remove(), 5000);
                }
                // Sekarang tiap 200ms bikin 2 emoji jatuh
                setInterval(() => {
                    createEmoji();
                    createEmoji();
                }, 500);
            });
        </script>

        <div class="card shadow-lg p-4" style="width: 400px; border-radius: 25px;">
            <h2 class="text-center mb-4" style="color:#d63384; font-weight:bold;">
                🍓 Login 🍓
            </h2>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input id="email" type="email" class="form-control rounded-pill" name="email"
                        value="{{ old('email') }}" required autofocus>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input id="password" type="password" class="form-control rounded-pill" name="password" required>
                </div>

                <div class="mb-3 form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                    <label class="form-check-label" for="remember">
                        Remember Me
                    </label>
                </div>

                <button type="submit" class="btn w-100 text-white"
                    style="background-color:#ff4d6d; border-radius:50px; font-weight:bold;">
                    Login
                </button>
            </form>

            <p class="text-center mt-3">
                Don't have an account? <a href="{{ route('register') }}" style="color:#d63384; font-weight:bold;">Register 🎀</a>
            </p>
        </div>
    </div>
@endsection
