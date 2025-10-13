<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaduan Masyarakat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> <!-- Bootstrap CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet"> <!-- Google Fonts -->

    <style>
        body { 
            background: linear-gradient(135deg, rgba(255, 96, 186, 0.4), rgba(254, 207, 239, 0.4)),
                url("{{ asset('assets/img/well.jpeg') }}") no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Poppins', sans-serif;
            overflow: hidden;
        }

        /* Navbar */
        nav {
            position: absolute;
            top: 0;
            width: 100%;
            padding: 15px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: linear-gradient(90deg, #ff67ae, #ff489b);
            color: white;
            font-weight: 600;
            letter-spacing: 0.5px;
            z-index: 10;
            box-shadow: 0 2px 10px rgba(214, 51, 132, 0.3);
        }

        nav a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
            transition: 0.3s;
            position: relative;
            cursor: pointer;
        }

        nav a:hover {
            color: #ffd6f6;
        }

        /* efek garis bawah saat hover */
        nav a::after {
            content: "";
            position: absolute;
            bottom: -3px;
            left: 0;
            width: 0;
            height: 2px;
            background: #ffd6f6;
            transition: width 0.3s ease;
        }

        nav a:hover::after {
            width: 100%;
        }


        /* kotak putih transparan */
        .card {
            border-radius: 25px;
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.2);
            padding: 50px;
            text-align: center;
            background: rgba(255, 255, 255, 0.6);
            max-width: 600px;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
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
            box-shadow: 0 4px 10px rgba(255, 96, 186, 0.4);
        }

        .btn-login:hover,
        .btn-register:hover {
            transform: scale(1.05);
            box-shadow: 0 0 20px rgba(255, 105, 180, 0.6);
            background: linear-gradient(135deg, #ff77b7, #ff3d94);
        }

        footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background: linear-gradient(100deg, #ff91ce, #ff92c7);
            color: #fff;
            text-align: center;
            padding: 10px 0;
            font-weight: 500;
            font-size: 15px;
            letter-spacing: 0.5px;
            box-shadow: 0 -2px 8px rgba(0, 0, 0, 0.1);
        }

        footer span {
            color: #fff9ff;
            font-weight: 700;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav>
        <div>🌐💻📱 Public Complaints App</div>
        <div>
            <a data-bs-toggle="modal" data-bs-target="#homeModal">Home</a>  <!-- Tombol Home -->
            <a data-bs-toggle="modal" data-bs-target="#aboutModal">About</a> <!-- Tombol About -->
            <a data-bs-toggle="modal" data-bs-target="#contactModal">Contact</a> <!-- Tombol Contact -->
            <a data-bs-toggle="modal" data-bs-target="#helpModal">Help</a> <!-- Tombol Help -->
        </div>
    </nav>

    <!-- Card utama -->
    <div class="card">
        <h1>Welcome to the Public Complaints Application</h1>
        <div class="d-flex justify-content-center gap-4">
            <a href="{{ route('login') }}" class="btn btn-login btn-lg">Login🩷</a>
            <a href="{{ route('register') }}" class="btn btn-register btn-lg">Register🤍</a>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        © 2025 Public Complaints App | Developed by <span>Maselsa Gayatri</span>
    </footer>

    <!-- 🏠 HOME -->
    <div class="modal fade" id="homeModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius:20px;">
                <div class="modal-header" style="background:#ff3d94;">
                    <h5 class="modal-title">Beranda 🏠</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Aplikasi <b>Pengaduan Masyarakat</b> adalah platform digital untuk masyarakat yang ingin
                        menyampaikan laporan, saran, atau keluhan terkait pelayanan publik dan kondisi lingkungan
                        sekitar. 📢📱</p>

                    <p>Di sini, Masyarakat bisa:</p>
                    <ul>
                        <li>📝 Mengirim laporan secara cepat dan aman.</li>
                        <li>⏱️ Memantau status pengaduan secara real-time.</li>
                        <li>📊 Melihat tanggapan dari setiap pengaduan Anda.</li>
                        <li>🌍 Ikut berkontribusi dalam menciptakan lingkungan yang lebih baik.</li>
                        <li>🔔 Mendapat notifikasi saat laporan ditanggapi.</li>
                    </ul>

                    <p><i>Dengan Aplikasi Pengaduan Masyarakat, suara Anda menjadi langkah nyata menuju perubahan
                            positif! 🌟</i></p>
                </div>

            </div>
        </div>
    </div>

    <!-- ℹ️ ABOUT -->
    <div class="modal fade" id="aboutModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius:20px;">
                <div class="modal-header" style="background:#ff3d94;">
                    <h5 class="modal-title">Tentang Aplikasi ℹ️</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Aplikasi <b>Pengaduan Masyarakat</b> dikembangkan untuk menciptakan tata kelola pemerintahan
                        yang
                        lebih terbuka dan responsif terhadap masyarakat. 📱✨ </p>

                    <p>Membantu Masyarakat, untuk:</p>
                    <ul>
                        <li>💬 Mempermudah dalam menyampaikan laporan, keluhan,
                            atau pengaduan secara online tanpa harus datang langsung.</li>
                        <li>💻 Membantu dalam memantau pengaduan dengan lebih efektif.</li>
                    </ul>

                    <p><i>Dengan sistem digital ini, setiap suara masyarakat menjadi lebih didengar dan ditindaklanjuti
                            🧾</i></p>
                </div>
            </div>
        </div>
    </div>

    <!-- 💌 CONTACT -->
    <div class="modal fade" id="contactModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius:20px;">
                <div class="modal-header" style="background:#ff3d94;">
                    <h5 class="modal-title">Hubungi Kami 💌</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center">
                    <p>📧 <b>Email:</b> support@pengaduanapp.com</p>
                    <p>💬 <b>Instagram:</b> @maselsa.gayatri</p>
                    <p>🌐 <b>Website:</b> www.pengaduanmasyarakat.id</p>
                    <p>☎️ <b>Telepon Kantor:</b> (0281) 654321</p>
                    <p>📍 <b>Alamat:</b> Dusun 4, Gandasuli, Kec. Bobotsari, Kabupaten Purbalingga, Jawa Tengah 53353
                    </p>
                    <p>🗺️ <b>Maps:</b>
                        <a href="https://www.google.com/maps/place/M9R9%2BC7W,+Dusun+4,+Gandasuli,+Kec.+Bobotsari,+Kabupaten+Purbalingga,+Jawa+Tengah+53353"
                            target="_blank" rel="noopener noreferrer">
                            Lihat di Google Maps
                        </a>
                    </p>
                    <hr>
                    <p><i>Hubungi kami jika Anda mengalami kendala atau ingin memberikan saran untuk pengembangan
                            aplikasi 💬</i></p>
                </div>
            </div>
        </div>
    </div>

    <!-- 🆘 HELP -->
    <div class="modal fade" id="helpModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius:20px;">
                <div class="modal-header" style="background:#ff3d94;">
                    <h5 class="modal-title">Pusat Bantuan 🆘</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p><b>Cara menggunakan Aplikasi:</b></p>
                    <ol>
                        <li>👤 Daftar akun atau login sesuai data diri Anda.</li>
                        <li>📝 Klik <b>add complaint</b> dan isi pengaduan.</li>
                        <li>📤 Kirim pengaduan dan tunggu tanggapan dari petugas.</li>
                        <li>📬 Cek status pengaduan di menu <b>Tanggapan</b>.</li>
                    </ol>
                    <p class="mt-3"><i>Pastikan data yang Anda isi benar agar laporan cepat diproses! ⚠️</i></p>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> <!-- Bootstrap JS -->
</body>

</html>
