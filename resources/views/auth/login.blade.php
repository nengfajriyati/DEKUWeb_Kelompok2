@extends('layouts.auth')

@section('title', 'Masuk ke DEKU')
@section('subtitle', 'Kelola keuanganmu dengan mudah ✨')

@section('content')

@if(session('success'))
    <div class="alert alert-success text-center py-2">
        <i class="bi bi-check-circle me-1"></i>{{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger text-center py-2">
        <i class="bi bi-exclamation-circle me-1"></i>{{ $errors->first() }}
    </div>
@endif

<form method="POST" action="{{ route('login') }}">
    @csrf

    <div class="mb-3">
        <label class="form-label fw-semibold">Email</label>
        <div class="input-group">
            <span class="input-group-text bg-light">
                <i class="bi bi-envelope"></i>
            </span>
            <input type="email" name="email" class="form-control" placeholder="email@example.com" required autofocus>
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label fw-semibold">Password</label>
        <div class="input-group">
            <span class="input-group-text bg-light">
                <i class="bi bi-lock"></i>
            </span>
            <input type="password" name="password" class="form-control" placeholder="••••••••" required>
        </div>
    </div>

    <button class="btn btn-primary w-100 py-2 fw-semibold">
        <i class="bi bi-box-arrow-in-right me-1"></i> Masuk
    </button>

    <p class="mt-3 text-center text-muted">
        Belum punya akun?
        <a href="{{ route('register') }}" class="fw-semibold text-decoration-none">
            Daftar sekarang
        </a>
    </p>
</form>

@endsection
