<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <div class="logo-header" data-background-color="dark">
            <a href="{{ url('/') }}" class="logo">
                <img src="{{ asset('assets/img/kaiadmin/logo_light.svg') }}" alt="navbar brand" class="navbar-brand"
                    height="20" />
            </a>
        </div>
    </div>

    <div class="sidebar-wrapper scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-primary">
                {{-- Dashboard --}}
                <li class="nav-item {{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('user.dashboard') }}">
                        <i class="fas fa-home"></i>
                        <p>📊 Dashboard</p>
                    </a>
                </li>

                {{-- Form Pengaduan --}}
                <li class="nav-item {{ request()->routeIs('user.pengaduan.*') ? 'active' : '' }}">
                    <a href="{{ route('user.pengaduan.index') }}">
                        <i class="fas fa-clipboard-list"></i>
                        <p>📢 Form Pengaduan</p>
                    </a>
                </li>

                {{-- Notifikasi --}}
                <li class="nav-item {{ request()->is('notifikasi') ? 'active' : '' }}">
                    <a href="{{ route('user.notifikasi') }}">
                        <i class="fas fa-bell"></i>
                        <p>🔔 Notifikasi</p>
                    </a>
                </li>

                {{-- Tanggapan --}}
                <li class="nav-item {{ request()->routeIs('user.tanggapan.index') ? 'active' : '' }}">
                    <a href="{{ route('user.tanggapan.index') }}">
                        <i class="fas fa-comments"></i>
                        <p>💬 Tanggapan</p>
                    </a>
                </li>

                {{-- Logout --}}
                <li class="nav-item">
                    <a href="{{ route('logout') }}">
                        <i class="fas fa-sign-out-alt"></i>
                        <p>💖 Logout</p>
                    </a>
                </li>
            </ul>

            {{-- Bagian bawah sidebar --}}
            <div class="mt-5 p-3 text-center" style="border-top: 1px dashed pink;">
                <p class="text-white mb-1">👩🏻‍💻 {{ auth()->user()->name }}</p>
                <small class="text-light">✨ Role: {{ auth()->user()->role }} ✨</small>

                <div class="mt-3">
                    <p class="text-pink">💕 Terima kasih sudah pakai 💕<br>
                        <strong>Sistem Pengaduan Masyarakat</strong> 🌸
                    </p>
                </div>

                <div class="mt-2">
                    <span style="font-size:20px;">💞🌷🧚🏻‍♀️💖✨</span>
                </div>
            </div>
        </div>
    </div>
</div>
