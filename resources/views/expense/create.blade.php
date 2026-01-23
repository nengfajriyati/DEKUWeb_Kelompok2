@extends('layouts.admin')

@section('page-title', 'Tambah Pengeluaran')

@section('content')

<div class="card shadow-sm border-0">
    <div class="card-body">

        <h4 class="fw-bold mb-4">
            <i class="bi bi-dash-circle text-danger me-2"></i>
            Tambah Pengeluaran
        </h4>

        <form action="{{ route('expense.store') }}" method="POST">
            @csrf

            {{-- TANGGAL --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">Tanggal</label>
                <input type="date" name="date" class="form-control" required>
            </div>

            {{-- PILIH DOMPET --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">Pilih Dompet</label>
                <select name="wallet_id" class="form-select form-select-lg" required>
                    <option value="" disabled selected>
                        🔽 Pilih Dompet
                    </option>

                    @foreach($wallets as $wallet)
                        <option value="{{ $wallet->id }}">
                            💳 {{ $wallet->name }}
                            — Saldo: Rp {{ number_format($wallet->balance,0,',','.') }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- NOMINAL --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">Nominal</label>
                <input type="number" name="amount" min="1" class="form-control" required>
            </div>

            {{-- KETERANGAN --}}
            <div class="mb-4">
                <label class="form-label fw-semibold">Keterangan</label>
                <input type="text" name="description" class="form-control">
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('expense.index') }}" class="btn btn-secondary">
                    Kembali
                </a>
                <button class="btn btn-danger">
                    <i class="bi bi-save"></i> Simpan
                </button>
            </div>

        </form>
    </div>
</div>

@endsection
