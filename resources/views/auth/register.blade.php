@extends('layouts.auth')

@section('title', 'Buat Akun DEKU')
@section('subtitle', 'Ayo mulai catat keuanganmu!')

@section('content')

@if($errors->any())
    <div class="alert alert-danger py-2">{{ $errors->first() }}</div>
@endif

<form method="POST" action="{{ route('register') }}">
    @csrf

    <div class="mb-3">
        <label class="form-label">Nama Lengkap</label>
        <input type="text" name="name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control" required>
    </div>

    <button class="btn btn-success w-100">Daftar</button>

    <p class="mt-3 text-center">
        Sudah punya akun?
        <a href="{{ route('login') }}">Masuk</a>
    </p>
</form>

@endsection
