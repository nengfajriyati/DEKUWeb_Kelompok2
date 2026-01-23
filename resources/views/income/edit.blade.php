@extends('layouts.admin')

@section('page-title', 'Edit Pemasukan')

@section('content')

<div class="card shadow-sm border-0">
    <div class="card-body">

        <h4 class="fw-bold mb-4">
            <i class="bi bi-pencil-square text-warning me-2"></i>
            Edit Pemasukan
        </h4>

        <form action="{{ route('income.update', $income->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- TANGGAL --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">Tanggal</label>
                <input type="date"
                       name="date"
                       class="form-control"
                       value="{{ $income->date->format('Y-m-d') }}"
                       required>
            </div>

            {{-- PILIH DOMPET --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">Pilih Dompet</label>
                <select name="wallet_id" class="form-select form-select-lg" required>
                    @foreach($wallets as $wallet)
                        <option value="{{ $wallet->id }}"
                            {{ $wallet->id == $income->wallet_id ? 'selected' : '' }}>
                            💳 {{ $wallet->name }}
                            — Saldo: Rp {{ number_format($wallet->balance,0,',','.') }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- KETERANGAN --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">Keterangan</label>
                <input type="text"
                       name="description"
                       class="form-control"
                       value="{{ $income->description }}"
                       required>
            </div>

            {{-- NOMINAL --}}
            <div class="mb-4">
                <label class="form-label fw-semibold">Nominal</label>
                <input type="number"
                       name="amount"
                       min="1"
                       class="form-control"
                       value="{{ $income->amount }}"
                       required>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('income.index') }}" class="btn btn-secondary">
                    Kembali
                </a>
                <button class="btn btn-warning text-white">
                    <i class="bi bi-save"></i> Update
                </button>
            </div>

        </form>

    </div>
</div>

@endsection
