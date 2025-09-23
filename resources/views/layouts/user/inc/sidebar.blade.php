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

                {{-- Profil --}}
                <li class="nav-item {{ request()->routeIs('user.profil') ? 'active' : '' }}">
                    <a href="{{ route('user.profil') }}">
                        <i class="fas fa-clipboard-list"></i>
                        <p>🍓 Profil</p>
                    </a>
                </li>

                {{-- Form Pengaduan --}}
                <li class="nav-item {{ request()->routeIs('user.pengaduan.*') ? 'active' : '' }}">
                    <a href="{{ route('user.pengaduan.index') }}">
                        <i class="fas fa-clipboard-list"></i>
                        <p>📢 Pengaduan</p>
                    </a>
                </li>

                {{-- Notifikasi --}}
                <li class="nav-item {{ request()->is('user/notifikasi*') ? 'active' : '' }}">
                    <a href="{{ route('user.notifikasi.index') }}">
                        <i class="fas fa-bell"></i>
                        <p>🔔 Notifikasi</p>
                    </a>
                </li>

                {{-- Tanggapan --}}
                <li class="nav-item {{ request()->routeIs('user.tanggapan.index') ? 'active' : '' }}">
                    <a href="{{ route('user.tanggapan.index') }}">
                        <i class="fas fa-comments"></i>
                        <p>📩 Tanggapan</p>
                    </a>
                </li>

                {{-- Logout --}}
                <li class="nav-item">
                    <a href="#" class="nav-link"
                        onclick="event.preventDefault(); if(confirm('yakin mau logout? 💔')) document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i>
                        <p>💔 Logout</p>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>
