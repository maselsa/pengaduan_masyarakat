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
                <li class="nav-item active">
                    <a href="{{ url('/') }}">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/form-pengaduan') }}">
                        <i class="fas fa-edit"></i>
                        <p>Form Pengaduan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/data-pengaduan') }}">
                        <i class="fas fa-database"></i>
                        <p>Data Pengaduan</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
