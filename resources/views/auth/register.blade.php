@extends('layouts.auth')

@section('title', 'Buat Akun DEKU')
@section('subtitle', 'Ayo mulai catat keuanganmu! 🚀')

@section('content')

@if($errors->any())
    <div class="alert alert-danger text-center py-2">
        <i class="bi bi-exclamation-circle me-1"></i>{{ $errors->first() }}
    </div>
@endif

<form method="POST" action="{{ route('register') }}">
    @csrf

    <div class="mb-3">
        <label class="form-label fw-semibold">Nama Lengkap</label>
        <div class="input-group">
            <span class="input-group-text bg-light">
                <i class="bi bi-person"></i>
            </span>
            <input type="text" name="name" class="form-control" placeholder="Nama kamu" required>
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label fw-semibold">Email</label>
        <div class="input-group">
            <span class="input-group-text bg-light">
                <i class="bi bi-envelope"></i>
            </span>
            <input type="email" name="email" class="form-control" placeholder="email@example.com" required>
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label fw-semibold">Password</label>
        <div class="input-group">
            <span class="input-group-text bg-light">
                <i class="bi bi-lock"></i>
            </span>
            <input type="password" name="password" class="form-control" placeholder="Minimal 8 karakter" required>
        </div>
    </div>

    <button class="btn btn-success w-100 py-2 fw-semibold">
        <i class="bi bi-person-plus me-1"></i> Daftar
    </button>

    <p class="mt-3 text-center text-muted">
        Sudah punya akun?
        <a href="{{ route('login') }}" class="fw-semibold text-decoration-none">
            Masuk
        </a>
    </p>
</form>

@endsection
