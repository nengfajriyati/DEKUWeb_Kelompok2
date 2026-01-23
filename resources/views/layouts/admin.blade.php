<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('page-title') - DEKU</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- BOOTSTRAP --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    {{-- SWEETALERT --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            background: #f4f6fb;
            font-family: 'Segoe UI', sans-serif;
        }

        /* ===== SIDEBAR ===== */
        .sidebar {
            width: 240px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: linear-gradient(180deg, #0d1b2a, #1b263b);
            padding-top: 30px;
            z-index: 1040;
        }

        .sidebar a {
            color: #dce3f0;
            padding: 12px 22px;
            display: block;
            text-decoration: none;
            transition: 0.3s;
        }

        .sidebar a:hover {
            background: rgba(255,255,255,0.1);
            color: white;
            padding-left: 28px;
        }

        /* ===== CONTENT ===== */
        .content-wrapper {
            margin-left: 240px;
            padding: 24px;
            transition: all 0.3s;
        }

        .navbar {
            background: white;
            border-radius: 14px;
            padding: 14px 20px;
        }

        .card {
            border-radius: 16px;
            border: none;
        }

        /* ===== MOBILE ===== */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: 0.3s;
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .content-wrapper {
                margin-left: 0;
                padding: 16px;
            }
        }
    </style>
</head>

<body>

{{-- SIDEBAR --}}
<div class="sidebar" id="sidebar">
    <div class="text-center mb-4">
        <i class="bi bi-gem fs-1 text-info"></i>
        <h4 class="text-white fw-bold mt-2">DEKU</h4>
    </div>

    <a href="/dashboard"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a>
    <a href="/income"><i class="bi bi-wallet2 me-2"></i> Pemasukan</a>
    <a href="/expense"><i class="bi bi-cash-stack me-2"></i> Pengeluaran</a>
    <a href="/wallet"><i class="bi bi-bank me-2"></i> Dompet</a>
    <a href="/goal"><i class="bi bi-bullseye me-2"></i> Goals</a>
    <a href="/reminder"><i class="bi bi-bell me-2"></i> Reminder</a>
</div>

{{-- CONTENT --}}
<div class="content-wrapper">

    {{-- NAVBAR --}}
    <nav class="navbar shadow-sm mb-4 d-flex justify-content-between">

        <div class="d-flex align-items-center gap-2">
            {{-- HAMBURGER (MOBILE) --}}
            <button class="btn btn-outline-primary d-md-none"
                    onclick="toggleSidebar()">
                <i class="bi bi-list"></i>
            </button>

            <h5 class="m-0 fw-semibold">@yield('page-title')</h5>
        </div>

        <div class="d-flex align-items-center gap-3">
            <span class="text-secondary d-none d-md-inline">
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

<script>
function toggleSidebar() {
    document.getElementById('sidebar').classList.toggle('show');
}
</script>

</body>
</html>
