<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title') - DEKU</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #eef2f7;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .auth-card {
            width: 400px;
            border-radius: 12px;
            background: white;
        }

        .auth-title {
            font-size: 1.6rem;
            font-weight: 700;
            color: #0d1b2a;
        }

        .auth-subtitle {
            font-size: 0.95rem;
            color: #6c757d;
        }
    </style>
</head>
<body>

<div class="auth-card shadow p-4">
    <div class="text-center mb-4">
        <div class="auth-title">@yield('title')</div>
        <div class="auth-subtitle">@yield('subtitle')</div>
    </div>

    @yield('content')
</div>

</body>
</html>
