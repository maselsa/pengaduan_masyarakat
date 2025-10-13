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
                <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-home"></i>
                        <p>📊 Dashboard</p>
                    </a>
                </li>

                {{-- Profil --}}
                <li class="nav-item {{ request()->routeIs('admin.profil*') ? 'active' : '' }}">
                    <a href="{{ route('admin.profil.index') }}">
                        <i class="fas fa-clipboard-list"></i>
                        <p>🍓 Profil</p>
                    </a>
                </li>

                <li class="nav-item {{ request()->is('data-masyarakat*') ? 'active' : '' }}">
                    <a href="{{ url('/data-masyarakat') }}">
                        <i class="fas fa-database"></i>
                        <p>👥 Data Masyarakat</p>
                    </a>
                </li>

                <li class="nav-item {{ request()->routeIs('admin.petugas*') ? 'active' : '' }}">
                    <a href="{{ route('admin.petugas.index') }}">
                        <i class="fas fa-database"></i>
                        <p>👮 Data Petugas</p>
                    </a>
                </li>

                <li class="nav-item {{ request()->is('data-kategori*') ? 'active' : '' }}">
                    <a href="{{ url('/data-kategori') }}">
                        <i class="fas fa-database"></i>
                        <p>🗂️ Data Kategori</p>
                    </a>
                </li>

                <li class="nav-item {{ request()->is('data-pengaduan*') ? 'active' : '' }}">
                    <a href="{{ url('/data-pengaduan') }}">
                        <i class="fas fa-database"></i>
                        <p>📢 Data Pengaduan</p>
                    </a>
                </li>

                <li class="nav-item {{ request()->is('admin/tanggapan*') ? 'active' : '' }}">
                    <a href="{{ url('/admin/tanggapan') }}">
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
