<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('page-title') - DEKU</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- SWEETALERT -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            background: #f4f6fb;
            font-family: 'Segoe UI', sans-serif;
        }

        /* SIDEBAR */
        .sidebar {
            width: 240px;
            height: 100vh;
            position: fixed;
            background: linear-gradient(180deg, #0d1b2a, #1b263b);
            padding-top: 30px;
        }

        .logo {
            text-align: center;
            margin-bottom: 40px;
        }

        .logo i {
            font-size: 48px;
            color: #4cc9f0;
        }

        .logo h4 {
            color: white;
            margin-top: 10px;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .sidebar a {
            color: #dce3f0;
            padding: 12px 22px;
            display: block;
            text-decoration: none;
            font-size: 15px;
            transition: 0.3s;
        }

        .sidebar a:hover {
            background: rgba(255,255,255,0.1);
            color: white;
            padding-left: 28px;
        }

        /* CONTENT */
        .content-wrapper {
            margin-left: 240px;
            padding: 30px;
        }

        .navbar {
            background: white;
            border-radius: 14px;
            padding: 16px 24px;
        }

        .card {
            border-radius: 16px;
            border: none;
            transition: 0.3s;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 30px rgba(0,0,0,0.08);
        }

        .stat-icon {
            font-size: 36px;
            opacity: 0.15;
            position: absolute;
            right: 20px;
            top: 20px;
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
    <a href="/reminder"><i class="bi bi-bell me-2"></i> Reminder</a>
</div>

<!-- CONTENT -->
<div class="content-wrapper">

    <!-- TOP NAV -->
    <nav class="navbar shadow-sm mb-4">
        <div class="d-flex align-items-center">
            <i class="bi bi-grid-fill text-primary me-2 fs-4"></i>
            <h5 class="m-0 fw-semibold">@yield('page-title')</h5>
        </div>

        <div class="d-flex align-items-center">
            <span class="me-3 text-secondary">
                Halo, {{ Auth::user()->name ?? 'User' }} 👋
            </span>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-outline-danger btn-sm">
                    <i class="bi bi-box-arrow-right"></i>
                </button>
            </form>
        </div>
    </nav>

    @yield('content')

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
