@extends('layouts.admin')

@section('page-title', 'Edit Pengeluaran')

@section('content')

@if(session('error'))
<script>
Swal.fire('Gagal', '{{ session('error') }}', 'error');
</script>
@endif

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('expense.update', $expense->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Dompet</label>
                <select name="wallet_id" class="form-select" required>
                    @foreach($wallets as $wallet)
                        <option value="{{ $wallet->id }}"
                            {{ $expense->wallet_id == $wallet->id ? 'selected' : '' }}>
                            {{ $wallet->name }} — Rp {{ number_format($wallet->balance, 0, ',', '.') }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Nominal</label>
                <input type="number" name="amount" min="1"
                       value="{{ $expense->amount }}"
                       class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal</label>
                <input type="date" name="date"
                       value="{{ $expense->created_at->format('Y-m-d') }}"
                       class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Keterangan</label>
                <input type="text" name="description"
                       value="{{ $expense->description }}"
                       class="form-control">
            </div>

            <button class="btn btn-warning">Update</button>
            <a href="{{ route('expense.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>

@endsection
