<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <div class="logo-header" data-background-color="dark">
            <a href="{{ url('/') }}" class="logo">
                <img src="{{ asset('assets/img/kaiadmin/logo_light.svg') }}" alt="navbar brand" class="navbar-brand" height="20" />
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
                    <a href="{{ url('notifikasi') }}">
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
            </ul>
        </div>
    </div>
</div>
