<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Pengaduan Masyarakat</title>
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
            background: url('assets/img/regiss.jpeg');
            overflow: hidden;
        }

        .card {
            width: 750px;
            border-radius: 25px;
            background-color: rgba(255, 255, 255, 0.6);
            padding: 30px;
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.2);
            text-align: center;
            position: relative;
            z-index: 2;
        }

        h2 {
            color: #d63384;
            font-weight: bold;
            margin-bottom: 30px;
        }

        .form-control.rounded-pill {
            border-radius: 50px;
            padding: 10px 20px;
        }

        .form-label {
            font-weight: 600;
            font-size: 0.95rem;
            color: #333;
        }

        .btn-register {
            background: linear-gradient(135deg, #ff9acb, #ff5fa2);
            color: white !important;
            border: none;
            border-radius: 20px;
            padding: 12px 30px;
            font-weight: bold;
            transition: 0.3s;
        }

        .btn-register:hover {
            background: linear-gradient(135deg, #ff77b7, #ff3d94);
            transform: scale(1.03);
        }

        .emoji {
            position: fixed;
            top: -50px;
            font-size: 28px;
            pointer-events: none;
            animation: fall linear forwards;
            z-index: 9999;
        }

        @keyframes fall {
            to {
                transform: translateY(100vh) rotate(360deg);
                opacity: 0;
            }
        }

        @media (max-width: 768px) {
            .card {
                width: 90%;
            }
        }
    </style>
</head>

<body>

    <!-- Emoji Jatuh -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const emojis = ["🤍"];

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
                createEmoji();
            }, 500);
        });
    </script>

    <!-- Register Form -->
    <div class="card register-card p-4">
        <h2 class="text-center mb-4">🤍 Register 🤍</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="row gx-3">
                <div class="col-md-6">
                    <div class="mb-3 text-start">
                        <label for="name" class="form-label">Name</label>
                        <input id="name" type="text" class="form-control rounded-pill" name="name" required>
                    </div>

                    <div class="mb-3 text-start">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" type="email" class="form-control rounded-pill" name="email" required>
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
                </div>

                <div class="col-md-6">
                    <div class="mb-3 text-start position-relative">
                        <label for="password-confirm" class="form-label">Confirm Password</label>
                        <div class="position-relative">
                            <input id="password-confirm" type="password" class="form-control rounded-pill pe-5"
                                name="password_confirmation" required>
                            <span id="togglePasswordConfirm"
                                style="position: absolute; top: 50%; right: 20px; transform: translateY(-50%); cursor: pointer; color: #ff5fa2; font-size: 20px;">
                                👁️
                            </span>
                        </div>
                    </div>

                    <div class="mb-3 text-start">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input id="phone" type="text" class="form-control rounded-pill" name="phone">
                    </div>

                    <div class="mb-3 text-start">
                        <label for="address" class="form-label">Address</label>
                        <input id="address" type="text" class="form-control rounded-pill" name="address">
                    </div>
                </div>
            </div>

            <div class="d-grid mt-3">
                <button type="submit" class="btn btn-register">Register 🤍</button>
            </div>
        </form>

        <p class="text-center mt-3">
            Already have an account?
            <a href="{{ route('login') }}" style="color:#d63384; font-weight:bold;">Login 🩷</a>
        </p>
    </div>

    <!-- Toggle Password Script -->
    <script>
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');

        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.style.color = type === 'password' ? '#ff5fa2' : '#ffffff';
        });

        const togglePasswordConfirm = document.getElementById('togglePasswordConfirm');
        const passwordConfirmInput = document.getElementById('password-confirm');

        togglePasswordConfirm.addEventListener('click', function() {
            const type = passwordConfirmInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordConfirmInput.setAttribute('type', type);
            this.style.color = type === 'password' ? '#ff5fa2' : '#ffffff';
        });
    </script>

</body>

</html>
