@extends('layouts.admin')

@section('page-title', 'Edit Dompet')

@section('content')

{{-- ALERT VALIDATION --}}
@if ($errors->any())
<script>
    Swal.fire({
        icon: 'error',
        title: 'Gagal',
        text: '{{ $errors->first() }}'
    });
</script>
@endif

<div class="container">
    <div class="card shadow-sm border-0">
        <div class="card-body">

            <h4 class="fw-bold mb-4">
                <i class="bi bi-pencil-square text-warning me-2"></i>
                Edit Dompet
            </h4>

            <form action="{{ route('wallet.update', $wallet->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- NAMA DOMPET --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Dompet</label>
                    <input type="text"
                           name="name"
                           class="form-control"
                           value="{{ old('name', $wallet->name) }}"
                           required>
                </div>

                {{-- SALDO (READ ONLY BIAR AMAN) --}}
                <div class="mb-4">
                    <label class="form-label fw-semibold">Saldo Saat Ini</label>
                    <input type="text"
                           class="form-control"
                           value="Rp {{ number_format($wallet->balance,0,',','.') }}"
                           readonly>
                </div>

                {{-- BUTTON --}}
                <div class="d-flex justify-content-between">
                    <a href="{{ route('wallet.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>

                    <button class="btn btn-warning text-white">
                        <i class="bi bi-save"></i> Update
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

{{-- SWEETALERT --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@endsection
