<nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">
    <div class="container-fluid">
        <ul class="navbar-nav topbar-nav ms-auto align-items-center">

            @guest
                {{-- Kalau belum login --}}
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">
                        <i class="fas fa-sign-in-alt"></i> Login
                    </a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">
                            <i class="fas fa-user-plus"></i> Register
                        </a>
                    </li>
                @endif
            @else
                {{-- Kalau sudah login --}}
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle d-flex align-items-center" id="userDropdown"
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        
                        {{-- Foto profil --}}
                        @if (Auth::user()->foto)
                            <img src="{{ asset('storage/' . Auth::user()->foto) }}" alt="Foto Profil"
                                style="width:30px; height:30px; border-radius:50%; object-fit:cover; margin-right:8px;">
                        @else
                            <img src="{{ asset('assets/img/default.jpg') }}" alt="Default Profil"
                                style="width:30px; height:30px; border-radius:50%; object-fit:cover; margin-right:8px;">
                        @endif
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li>
                            <a class="dropdown-item" href="{{ route('user.profil') }}">
                                <i class="fas fa-user"></i> 🍓 profile
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();if(confirm('Apakah anda yakin ingin logout?'))
                                document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i> 💔 logout
                            </a>
                        </li>
                    </ul>
                </li>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            @endguest

        </ul>
    </div>
</nav>
