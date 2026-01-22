@extends('layouts.admin')

@section('content')
<div class="container">
    <h4 class="mb-3">➖ Tambah Pengeluaran</h4>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('expense.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label>Dompet</label>
                    <select name="wallet_id" class="form-select" required>
                        <option value="">-- Pilih Dompet --</option>
                        @foreach($wallets as $wallet)
                            <option value="{{ $wallet->id }}">
                                {{ $wallet->name }} (Rp {{ number_format($wallet->balance,0,',','.') }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                <div class="mb-3">
                    <label>Nominal</label>
                    <input 
                        type="number" 
                        name="amount" 
                        class="form-control" 
                        min="1"
                        step="1"
                        onkeydown="return event.key !== '+'"
                        required
                    >
                </div>

                </div>

                <div class="mb-3">
                    <label>Deskripsi</label>
                    <textarea name="description" class="form-control"></textarea>
                </div>

                <button class="btn btn-danger">
                    <i class="bi bi-save"></i> Simpan
                </button>
                <a href="{{ route('expense.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
