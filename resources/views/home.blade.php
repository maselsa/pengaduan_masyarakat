<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaduan Masyarakat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Poppins', sans-serif;
        }

        .card {
            border-radius: 25px;
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.2);
            padding: 50px;
            text-align: center;
            background: white;
            max-width: 600px;
        }

        h1 {
            font-size: 2.2rem;
            font-weight: bold;
            margin-bottom: 40px;
            color: #d63384;
        }

        .btn-lg {
            font-size: 1.3rem;
            font-weight: bold;
            padding: 14px 35px;
            border-radius: 50px;
            transition: 0.3s;
        }

        .btn-login {
            background-color: #ff4d6d;
            border: none;
        }

        .btn-login:hover {
            background-color: #e63958;
        }

        .btn-register {
            background-color: #c471ed;
            border: none;
        }

        .btn-register:hover {
            background-color: #a345d3;
        }
    </style>
</head>

<body>
    <div class="card">
        <h1>🌸 Selamat Datang di Aplikasi Pengaduan Masyarakat 🌸</h1>
        <div class="d-flex justify-content-center gap-4">
            <a href="{{ route('login') }}" class="btn btn-login btn-lg text-white">Login</a>
            <a href="{{ route('register') }}" class="btn btn-register btn-lg text-white">Register</a>
        </div>
    </div>
</body>

</html>
