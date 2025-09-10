@if (!Route::is('login') && !Route::is('register'))
    <footer class="footer">
        <div class="container">
            <nav class="footer-nav">
                <ul>
                    <li><a class="nav-link" href="{{ url('/') }}">Pengaduan Masyarakat</a></li>
                </ul>
            </nav>
            <div class="copyright ml-auto">
                2025 &copy; Sistem Pengaduan
            </div>
        </div>
    </footer>
@endif
