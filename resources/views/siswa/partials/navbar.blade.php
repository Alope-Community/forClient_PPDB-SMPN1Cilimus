<nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNavbar">
    <div class="container">
        <a class="navbar-brand text-primary fw-bold" href="/">
            <i class="fas fa-graduation-cap me-2"></i>
            {{ config('app.name') }}
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">

                <li class="nav-item ms-3">
                    <a class="btn btn-warning btn-sm px-4 py-2 fw-semibold" href="{{ route('pendaftaran.index') }}">
                        <i class="fas fa-file-alt me-1"></i>Daftar Sekarang
                    </a>
                </li>

                {{-- Jika BELUM login --}}
                @guest
                <li class="nav-item ms-3">
                    <a class="btn btn-warning btn-sm px-4 py-2 fw-semibold" href="{{ route('auth.login') }}">
                        <i class="fas fa-sign-in me-1"></i>Masuk
                    </a>
                </li>
                @endguest

                @auth
                <li class="nav-item dropdown ms-3">
                    <a class="btn btn-outline-primary btn-sm dropdown-toggle px-4 py-2 fw-semibold" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="fas fa-user me-1"></i>{{ auth()->user()->name }}
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end">

                        {{-- Jika ADMIN --}}
                        @if(auth()->user()->role === 'admin')
                        <li>
                            <a href="{{ route('admin.dashboard') }}" class="dropdown-item">
                                <i class="fas fa-user-shield me-2"></i>Dashboard Admin
                            </a>
                        </li>
                        @endif

                        {{-- Jika SISWA --}}
                        @if(auth()->user()->role === 'siswa')
                        <li>
                            <a href="{{ route('siswa.dashboard') }}" class="dropdown-item">
                                <i class="fas fa-user-graduate me-2"></i>Dashboard Siswa
                            </a>
                        </li>
                        @endif

                        <li><hr class="dropdown-divider"></li>

                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button class="dropdown-item" type="submit">
                                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>