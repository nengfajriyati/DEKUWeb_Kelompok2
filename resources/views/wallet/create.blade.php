@extends('layouts.admin')

@section('page-title', 'Tambah Dompet')

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card">
    <div class="card-body">

        <form action="{{ route('wallet.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>Nama Dompet</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Saldo Awal</label>
                <input type="number" name="balance" class="form-control" required>
            </div>

            <button class="btn btn-success">Simpan</button>
            <a href="{{ route('wallet.index') }}" class="btn btn-secondary">Kembali</a>

        </form>

    </div>
</div>

@endsection
