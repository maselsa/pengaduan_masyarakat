<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>@yield('title', 'Pengaduan Masyarakat')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets/img/kaiadmin/favicon.ico') }}" type="image/x-icon" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/plugins.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/kaiadmin.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">


</head>

<body class="{{ Request::is('login') || Request::is('register') ? 'auth' : '' }}">

    @if (Request::is('login') || Request::is('register'))
        {{-- Khusus login & register, cuma content aja --}}
        <main style="width:100%;">
            @yield('content')
        </main>
    @else
        <div class="wrapper">
            <div class="main-panel">
                {{-- Sidebar --}}
                @auth
                    @if (Auth::user()->role == 'admin')
                        @include('layouts.admin.inc.sidebar')
                    @elseif(Auth::user()->role == 'user')
                        @include('layouts.user.inc.sidebar')
                    @endif
                @endauth

                {{-- Navbar --}}
                @auth
                    @if (Auth::user()->role == 'admin')
                        @include('layouts.admin.inc.navbar')
                    @elseif(Auth::user()->role == 'user')
                        @include('layouts.user.inc.navbar')
                    @endif
                @endauth

                {{-- Content --}}
                <div class="content">
                    <div class="page-inner">
                        @yield('content')
                    </div>
                </div>

                {{-- Footer --}}
                @include('layouts.admin.inc.footer')
                @include('layouts.user.inc.footer')
            </div>
        </div>
    @endif

    <!-- Core JS -->
    <script src="{{ asset('assets/js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/kaiadmin.min.js') }}"></script>

    <!-- Custom JS -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/kaiadmin.min.js') }}"></script>
</body>

</html>
