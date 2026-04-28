<nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNavbar">
    <div class="container">
        <a class="navbar-brand text-primary fw-bold" href="#">
            <i class="fas fa-graduation-cap me-2"></i>
            {{ config('app.name', 'SMK NEGERI 1') }}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('index') }}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#tentang">Tentang</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#jadwal">Jadwal</a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link" href="#kontak">Kontak</a>
                </li> --}}
                <li class="nav-item ms-3">
                    <a class="btn btn-warning btn-sm px-4 py-2 fw-semibold" href="{{ route('pendaftaran.index') }}">
                        <i class="fas fa-file-alt me-1"></i>Daftar Sekarang
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<style>
    .nav-link.active {
        color: var(--primary-color) !important;
        font-weight: 600;
        position: relative;
    }
    .nav-link.active::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 0;
        width: 100%;
        height: 2px;
        background: var(--accent-color);
    }
</style>