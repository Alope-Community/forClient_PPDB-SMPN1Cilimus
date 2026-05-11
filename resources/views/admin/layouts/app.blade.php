<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        nav {
            /* height: 100vh; */
            background-color: #5b0e7f;
            color: #fff !important;
        }
        .sidebar {
            height: 100vh;
            background-color: #333;
            color: #fff;
        }
        .sidebar a {
            color: #fff;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #4a0c69;
            display: block;
        }
        .bg-primary{
            background-color: #5b0e7f !important;
        }
    </style>

    @stack('styles')
</head>
<body>

    {{-- @include('admin.partials.navbar') --}}

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 p-0">
                @include('admin.partials.sidebar')
            </div>

            <div class="col-md-10 p-4">

                <!-- PAGE HEADER -->
                {{-- <div class="card border-0 shadow-sm mb-4 bg-primary">
                    <div class="card-body d-flex justify-content-between align-items-center">

                        <div>
                            <h4 class="fw-bold mb-1 text-white">@yield('page_title', 'Dashboard')</h4>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0 small">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('admin.dashboard') }}" class="text-decoration-none">
                                            Admin PPDB
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item active text-white">
                                        @yield('page_title', 'Dashboard')
                                    </li>
                                </ol>
                            </nav>
                        </div>

                        <div>
                            @yield('page_action')
                        </div>

                    </div>
                </div> --}}

                <!-- CONTENT -->
                @yield('content')

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>