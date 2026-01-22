@extends('layouts.admin')

@section('content')
<div class="container">
    <h4 class="fw-bold mb-4">✏️ Edit Pemasukan</h4>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('income.update', $income->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Dompet</label>
                    <select name="wallet_id" class="form-select" required>
                        @foreach($wallets as $wallet)
                            <option value="{{ $wallet->id }}" {{ $income->wallet_id == $wallet->id ? 'selected' : '' }}>
                                {{ $wallet->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jumlah</label>
                    <input type="number" name="amount" class="form-control" min="1" value="{{ $income->amount }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal</label>
                    <input type="date" name="date" class="form-control" value="{{ $income->date }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Keterangan</label>
                    <input type="text" name="description" class="form-control" value="{{ $income->description }}">
                </div>

                <button class="btn btn-warning">💾 Update</button>
                <a href="{{ route('income.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
