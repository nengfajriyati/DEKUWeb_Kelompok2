@extends('layouts.auth')

@section('title', 'Masuk ke DEKU')
@section('subtitle', 'Kelola keuanganmu dengan mudah ✨')

@section('content')

@if(session('success'))
    <div class="alert alert-success py-2">{{ session('success') }}</div>
@endif

@if($errors->any())
    <div class="alert alert-danger py-2">{{ $errors->first() }}</div>
@endif

<form method="POST" action="{{ route('login') }}">
    @csrf

    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" required autofocus>
    </div>

    <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control" required>
    </div>

    <button class="btn btn-primary w-100">Masuk</button>

    <p class="mt-3 text-center">
        Belum punya akun?
        <a href="{{ route('register') }}">Daftar sekarang</a>
    </p>
</form>

@endsection
