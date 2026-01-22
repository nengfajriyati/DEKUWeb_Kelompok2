<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title') - DEKU</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #4cc9f0, #4361ee);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .auth-card {
            width: 400px;
            border-radius: 14px;
            background: white;
            padding: 30px;
        }
    </style>
</head>
<body>

<div class="auth-card shadow">
    <h3 class="text-center fw-bold">@yield('title')</h3>
    <p class="text-center text-muted">@yield('subtitle')</p>
    @yield('content')
</div>

</body>
</html>
