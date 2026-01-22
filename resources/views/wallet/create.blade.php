@extends('layouts.admin')

@section('page-title', 'Tambah Dompet')

@section('content')

<div class="card shadow-sm border-0">
    <div class="card-body">

        <h5 class="fw-bold mb-4">
            <i class="bi bi-gem text-primary me-2"></i> Tambah Dompet Baru
        </h5>

        <form action="{{ route('wallet.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nama Dompet</label>
                <input type="text"
                       name="name"
                       class="form-control"
                       placeholder="Contoh: Dompet Utama"
                       required>
            </div>

            <div class="mb-4">
                <label class="form-label">Saldo Awal</label>
                <input type="number"
                       name="balance"
                       class="form-control"
                       placeholder="0"
                       min="0"
                       required>
            </div>

            <div class="d-flex gap-2">
                <button class="btn btn-success">
                    <i class="bi bi-check-circle me-1"></i> Simpan
                </button>
                <a href="{{ route('wallet.index') }}" class="btn btn-secondary">
                    Kembali
                </a>
            </div>
        </form>

    </div>
</div>

@endsection
