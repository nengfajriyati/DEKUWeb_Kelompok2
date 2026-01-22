@extends('layouts.admin')

@section('page-title', 'Tambah Pemasukan')

@section('content')

<div class="card">
    <div class="card-body">

        <form action="{{ route('income.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>Dompet</label>
                <select name="wallet_id" class="form-control" required>
                    <option value="">-- Pilih Dompet --</option>
                    @foreach($wallets as $wallet)
                        <option value="{{ $wallet->id }}">
                            {{ $wallet->name }} (Rp {{ number_format($wallet->balance) }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Nominal</label>
                <input type="number" name="amount" min="1" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Keterangan</label>
                <input type="text" name="description" class="form-control" required>
            </div>

            <button class="btn btn-success">
                <i class="bi bi-save"></i> Simpan
            </button>

            <a href="{{ route('income.index') }}" class="btn btn-secondary">
                Kembali
            </a>

        </form>

    </div>
</div>

@endsection
