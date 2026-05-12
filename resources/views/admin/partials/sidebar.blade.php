<div class="sidebar p-3 d-flex flex-column position-fixed vh-100" style="width: 250px; left: 0; top: 0; overflow-y: auto;">

    <!-- LOGO / TITLE -->
    <div class="mb-4 text-center">
        <img src="https://smpn1cilimus.sch.id/wp-content/uploads/2021/07/Untitled-design.png" class="me-2 mb-3" style="width: 70px" />
        <h5 class="fw-bold mb-0">Admin SPBM</h5>
        <small class="text-light opacity-75">SMPN 1 Cilimus</small>
    </div>

    <!-- MENU -->
    <ul class="nav nav-pills flex-column gap-2">

        <!-- Dashboard -->
        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}"
               class="nav-link d-flex align-items-center gap-2 
               {{ request()->routeIs('admin.dashboard') ? 'active bg-white text-dark fw-semibold' : 'text-white' }}">
               
                <i class="fa-solid fa-chart-line"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <!-- Pendaftar -->
        <li class="nav-item">
            <a href="{{ route('admin.pendaftar.index') }}"
               class="nav-link d-flex align-items-center gap-2 
               {{ request()->routeIs('admin.pendaftar.*') ? 'active bg-white text-dark fw-semibold' : 'text-white' }}">
               
                <i class="fa-solid fa-users"></i>
                <span>Pendaftar</span>
            </a>
        </li>

    </ul>
    <div class="mt-auto">

        <!-- FOOTER -->
        <div class="pt-4 text-center mb-3">
            <small class="text-light opacity-50">
                © {{ date('Y') }} SPBM
            </small>
        </div>

        <!-- LOGOUT BUTTON -->
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger w-100 d-flex align-items-center justify-content-center gap-2">
                <i class="fa-solid fa-right-from-bracket"></i>
                Logout
            </button>
        </form>

    </div>

    <!-- FOOTER -->
    {{-- <div class="mt-auto pt-4 text-center">
        <small class="text-light opacity-50">
            © {{ date('Y') }} PPDB
        </small>
    </div> --}}

</div>