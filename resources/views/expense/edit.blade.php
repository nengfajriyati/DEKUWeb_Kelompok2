@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-3">✏️ Edit Pengeluaran</h4>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('expenses.update',$expense->id) }}" method="POST">
                @csrf @method('PUT')

                <div class="mb-3">
                    <label>Dompet</label>
                    <select name="wallet_id" class="form-select">
                        @foreach($wallets as $wallet)
                            <option value="{{ $wallet->id }}"
                                {{ $expense->wallet_id == $wallet->id ? 'selected' : '' }}>
                                {{ $wallet->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Nominal</label>
                    <input type="number" name="amount" class="form-control"
                        value="{{ $expense->amount }}" min="1">
                </div>

                <div class="mb-3">
                    <label>Deskripsi</label>
                    <textarea name="description" class="form-control">{{ $expense->description }}</textarea>
                </div>

                <button class="btn btn-warning">
                    <i class="bi bi-save"></i> Update
                </button>
                <a href="{{ route('expenses.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
