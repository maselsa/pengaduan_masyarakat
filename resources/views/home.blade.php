<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaduan Masyarakat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            /* Background gambar + gradient overlay */
            background: linear-gradient(135deg, rgba(255, 96, 186, 0.6), rgba(254, 207, 239, 0.6)),
                url("{{ asset('assets/img/well.jpeg') }}") no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Poppins', sans-serif;
            overflow: hidden;
        }

        .card {
            border-radius: 25px;
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.2);
            padding: 50px;
            text-align: center;
            background: rgba(255, 255, 255, 0.9);
            /* transparan biar background keliatan */
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

        .btn-login,
        .btn-register {
            background: linear-gradient(135deg, #ff9acb, #ff5fa2);
            color: white !important;
            border: none;
            border-radius: 20px;
            padding: 12px 30px;
            transition: 0.3s;
        }

        .btn-login:hover,
        .btn-register:hover {
            background: linear-gradient(135deg, #ff77b7, #ff3d94);
        }
    </style>
</head>
<body>
    <div class="card">
        <h1> Welcome to the Public Complaints Application </h1>
        <div class="d-flex justify-content-center gap-4">
            <a href="{{ route('login') }}" class="btn btn-login btn-lg">Login🍓</a>
            <a href="{{ route('register') }}" class="btn btn-register btn-lg">Register🍒</a>
        </div>
    </div>
</body>

</html>
