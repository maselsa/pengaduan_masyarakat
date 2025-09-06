<nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">
    <div class="container-fluid">
        <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-user"></i> {{ Auth::user()->name ?? 'Guest' }}
                </a>
            </li>
        </ul>
    </div>
</nav>
