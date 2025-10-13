<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Pengaduan Masyarakat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        html,
        body {
            margin: 0;
            padding: 0;
            height: 100%;
            width: 100%;
            font-family: 'Poppins', sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f0e5e0;
            background:
                url('{{ asset('assets/img/regiss.jpeg') }}');
            overflow: hidden;
        }

        .card {
            width: 400px;
            border-radius: 25px;
            background-color: rgba(255, 255, 255, 0.6);
            padding: 30px;
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        h2 {
            color: #d63384;
            font-weight: bold;
            margin-bottom: 30px;
        }

        .btn-login {
            background: linear-gradient(135deg, #ff9acb, #ff5fa2);
            color: white !important;
            border: none;
            border-radius: 20px;
            padding: 12px 30px;
            font-weight: bold;
            transition: 0.3s;
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #ff77b7, #ff3d94);
            transform: scale(1.03);
        }

        .emoji {
            position: fixed;
            top: -50px;
            font-size: 28px;
            pointer-events: none;
            animation: fall linear forwards;
            z-index: 0;
        }

        @keyframes fall {
            to {
                transform: translateY(100vh) rotate(360deg);
                opacity: 0;
            }
        }
    </style>
</head>

<body>

    <!-- Emoji Jatuh -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const emojis = ["🩷"];

            function createEmoji() {
                const emoji = document.createElement("div");
                emoji.className = "emoji";
                emoji.textContent = emojis[Math.floor(Math.random() * emojis.length)];
                emoji.style.left = Math.random() * 100 + "vw";
                emoji.style.animationDuration = (3 + Math.random() * 3) + "s";
                document.body.appendChild(emoji);
                setTimeout(() => emoji.remove(), 5000);
            }
            setInterval(() => {
                createEmoji();
                if (Math.random() > 0.5) createEmoji();
            }, 600);
        });
    </script>

    <!-- Login Form -->
    <div class="card register-card p-4">
        <h2 class="text-center mb-4">🩷 Login 🩷</h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3 text-start">
                <label for="email" class="form-label">Email Address</label>
                <input id="email" type="email" class="form-control rounded-pill" name="email" required
                    autofocus>
            </div>

            <div class="mb-3 text-start position-relative">
                <label for="password" class="form-label">Password</label>
                <div class="position-relative">
                    <input id="password" type="password" class="form-control rounded-pill pe-5" name="password"
                        required>
                    <span id="togglePassword"
                        style="position: absolute; top: 50%; right: 20px; transform: translateY(-50%); cursor: pointer; color: #ff5fa2; font-size: 20px;">
                        👁️
                    </span>
                </div>
            </div>

            <div class="mb-3 form-check text-start">
                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                <label class="form-check-label" for="remember">Remember Me</label>
            </div>

            <button type="submit" class="btn w-100 btn-login">Login 🩷</button>
        </form>

        <p class="text-center mt-3">
            Don't have an account?
            <a href="{{ route('register') }}" style="color:#d63384; font-weight:bold;">Register 🤍</a>
        </p>
    </div>

    <script>
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');

        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
        });
    </script>

</body>

</html>
