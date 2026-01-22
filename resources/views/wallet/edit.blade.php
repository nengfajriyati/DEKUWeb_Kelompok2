@extends('layouts.admin')

@section('page-title', 'Edit Dompet')

@section('content')

<div class="card shadow-sm border-0">
    <div class="card-body">

        <h5 class="fw-bold mb-4">
            <i class="bi bi-pencil-square text-warning me-2"></i> Edit Dompet
        </h5>

        <form action="{{ route('wallet.update', $wallet->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="form-label">Nama Dompet</label>
                <input type="text"
                       name="name"
                       value="{{ $wallet->name }}"
                       class="form-control"
                       required>
            </div>

            <div class="d-flex gap-2">
                <button class="btn btn-success">
                    Simpan Perubahan
                </button>
                <a href="{{ route('wallet.index') }}" class="btn btn-secondary">
                    Batal
                </a>
            </div>
        </form>

    </div>
</div>

@endsection
