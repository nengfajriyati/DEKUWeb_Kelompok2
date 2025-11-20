<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('page-title') - DEKU</title>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body { background: #f5f7fb; }

        /* SIDEBAR */
        .sidebar {
            width: 240px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: #0d1b2a;
            padding-top: 25px;
        }

        .sidebar .logo {
            text-align: center;
            margin-bottom: 35px;
        }

        .sidebar .logo i {
            font-size: 42px;
            color: #4cc9f0;
        }

        .sidebar .logo h4 {
            color: #fff;
            margin-top: 8px;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .sidebar a {
            color: #dce3f0;
            display: block;
            padding: 12px 22px;
            font-size: 15px;
            text-decoration: none;
        }
        .sidebar a:hover {
            background: #1b263b;
            color: white;
        }

        /* CONTENT */
        .content-wrapper {
            margin-left: 240px;
            padding: 25px;
        }
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <div class="sidebar">

        <div class="logo">
            <i class="bi bi-gem"></i>  
            <h4>DEKU</h4>
        </div>

        <a href="/dashboard"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a>
        <a href="/income"><i class="bi bi-wallet2 me-2"></i> Pemasukan</a>
        <a href="/expense"><i class="bi bi-cash-stack me-2"></i> Pengeluaran</a>
        <a href="/wallet"><i class="bi bi-bank me-2"></i> Dompet</a>
        <a href="/goal"><i class="bi bi-bullseye me-2"></i> Goals</a>
        <a href="/budget"><i class="bi bi-bar-chart me-2"></i> Budget</a>
        <a href="/reminder"><i class="bi bi-bell me-2"></i> Reminder</a>

    </div>

    <!-- MAIN CONTENT -->
    <div class="content-wrapper">

        <!-- TOP NAVBAR -->
        <nav class="navbar bg-white shadow-sm rounded mb-4 px-4 py-3"
             style="border: 1px solid #e6e9ef;">
            
            <div class="container-fluid">

                <!-- ICON + PAGE TITLE -->
                <div class="d-flex align-items-center">
                    <i class="bi bi-ui-checks-grid text-primary me-2" style="font-size: 1.4rem;"></i>
                    <h4 class="m-0 fw-semibold text-dark">@yield('page-title')</h4>
                </div>

                <!-- RIGHT SECTION -->
                <div class="d-flex align-items-center">

                    <span class="me-3 text-secondary fw-medium">
                        Halo, {{ Auth::user()->name ?? 'User' }} 👋
                    </span>

                    @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn btn-outline-danger btn-sm px-3">
                            <i class="bi bi-box-arrow-right me-1"></i> Logout
                        </button>
                    </form>
                    @endauth

                </div>

            </div>

        </nav>

        <!-- PAGE CONTENT -->
        @yield('content')

    </div>

    <!-- BOOTSTRAP JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
