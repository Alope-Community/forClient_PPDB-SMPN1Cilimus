<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name'))</title>

    {{-- CSS Global --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">


    <style>
        
        * { font-family: 'Poppins', sans-serif; }
    
        /* Primary color override */
        :root {
            --bs-primary: #5b0e7f;
            --bs-primary-rgb: 91, 14, 127;
            --primary-gradient: linear-gradient(135deg, #2c5aa0 0%, #4a90e2 50%, #7ab8f5 100%);
            --accent-color: #28a745;
        }

        /* Button primary */
        .btn-primary {
            background-color: #5b0e7f !important;
            border-color: #5b0e7f !important;
        }

        .btn-primary:hover,
        .btn-primary:focus,
        .btn-primary:active {
            background-color: #4a0c69 !important;
            border-color: #4a0c69 !important;
        }

        /* Text primary */
        .text-primary {
            color: #5b0e7f !important;
        }

        /* Background primary */
        .bg-primary {
            background-color: #5b0e7f !important;
        }

        /* Border primary */
        .border-primary {
            border-color: #5b0e7f !important;
        }

        /* Link */
        a.text-primary,
        a {
            color: #5b0e7f;
        }

        a:hover {
            color: #4a0c69;
        }

        /* Outline button */
        .btn-outline-primary {
            color: #5b0e7f !important;
            border-color: #5b0e7f !important;
        }

        .btn-outline-primary:hover {
            background-color: #5b0e7f !important;
            color: #fff !important;
        }


         :root {
        --primary-color: #2c5aa0;
    }
    </style>

    @stack('styles')
</head>
<body>

    {{-- Navbar --}}
    @include('siswa.partials.navbar')

    @yield('content')

    {{-- JS Global --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
</body>
</html>