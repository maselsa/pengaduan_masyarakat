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

                <li class="nav-item {{ request()->is('data-masyarakat*') ? 'active' : '' }}">
                    <a href="{{ url('/data-masyarakat') }}">
                        <i class="fas fa-database"></i>
                        <p>🧑‍🤝‍🧑 Data Masyarakat</p>
                    </a>
                </li>

                <li class="nav-item {{ request()->is('data-petugas*') ? 'active' : '' }}">
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

                <li class="nav-item {{ request()->is('feedback*') ? 'active' : '' }}">
                    <a href="{{ url('/feedback') }}">
                        <i class="fas fa-database"></i>
                        <p>💬 Feedback</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
