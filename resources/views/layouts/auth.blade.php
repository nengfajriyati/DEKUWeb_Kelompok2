<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title') - DEKU</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: radial-gradient(circle at top left, #72f0c1 0%, #4cc9f0 35%, #4361ee 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: "Poppins", sans-serif;
        }

        .auth-card {
            width: 430px;
            border-radius: 22px;
            background: rgba(255, 255, 255, 0.96);
            padding: 34px 34px;
            box-shadow: 0 22px 70px rgba(0,0,0,0.16);
            border: 1px solid rgba(255,255,255,0.75);
            position: relative;
            overflow: hidden;
        }

        /* modern glow effect */
        .auth-card::before {
            content: "";
            position: absolute;
            width: 220px;
            height: 220px;
            background: radial-gradient(circle at center, rgba(76,201,240,0.35), transparent 65%);
            top: -70px;
            right: -80px;
            border-radius: 50%;
            pointer-events: none;
        }

        .auth-card::after {
            content: "";
            position: absolute;
            width: 260px;
            height: 260px;
            background: radial-gradient(circle at center, rgba(67,97,238,0.35), transparent 65%);
            bottom: -100px;
            left: -100px;
            border-radius: 50%;
            pointer-events: none;
        }

        .auth-card .header {
            position: relative;
            z-index: 2;
        }

        .auth-card h3 {
            font-size: 28px;
            letter-spacing: 0.5px;
        }

        .auth-card p {
            margin-bottom: 20px;
        }

        .divider {
            height: 1px;
            background: rgba(0,0,0,0.08);
            margin: 20px 0 22px;
        }

        .auth-card .btn-custom {
            width: 100%;
            border-radius: 14px;
            padding: 12px 14px;
            font-weight: 700;
            letter-spacing: 0.4px;
            transition: transform .2s ease, box-shadow .2s ease;
        }

        .auth-card .btn-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 30px rgba(67,97,238,0.25);
        }

        .auth-card .form-control {
            border-radius: 14px;
            padding: 12px 14px;
            box-shadow: none;
            border: 1px solid rgba(0,0,0,0.12);
        }

        .auth-card .form-control:focus {
            border-color: #4361ee;
            box-shadow: 0 0 0 4px rgba(67,97,238,0.18);
        }

        @media (max-width: 480px) {
            .auth-card {
                width: 92%;
                padding: 26px;
            }
        }
    </style>
</head>
<body>

<div class="auth-card">
    <div class="header text-center">
        <h3 class="fw-bold">@yield('title')</h3>
        <p class="text-muted">@yield('subtitle')</p>
    </div>

    <div class="divider"></div>

    @yield('content')
</div>

</body>
</html>
