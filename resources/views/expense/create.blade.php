@extends('layouts.admin')

@section('page-title', 'Tambah Pengeluaran')

@section('content')

<div class="card">
    <div class="card-body">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('expense.store') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label>Dompet</label>
                    <select name="wallet_id" class="form-control" required>
                        <option value="">-- Pilih Dompet --</option>
                        @foreach ($wallets as $wallet)
                            <option value="{{ $wallet->id }}">
                                {{ $wallet->name }}
                            </option>
                        @endforeach
                    </select>
            </div>
            
            <div class="mb-3">
                <label>Nominal</label>
                <input type="number" name="amount" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Keterangan</label>
                <input type="text" name="description" class="form-control" required>
            </div>

            <button class="btn btn-success">Simpan</button>
            <a href="{{ route('expense.index') }}" class="btn btn-secondary">Kembali</a>

        </form>

    </div>
</div>

@endsection
