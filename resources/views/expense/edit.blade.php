@extends('layouts.admin')

@section('page-title', 'Edit Pengeluaran')

@section('content')

<div class="card">
    <div class="card-body">

        <form action="{{ route('expense.update', $expense->id) }}" method="POST">
            @csrf @method('PUT')

            <div class="mb-3">
                <label>Nominal</label>
                <input type="number" name="amount" value="{{ $expense->amount }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Keterangan</label>
                <input type="text" name="description" value="{{ $expense->notes }}" class="form-control" required>
            </div>

            <button class="btn btn-primary">Update</button>
            <a href="{{ route('expense.index') }}" class="btn btn-secondary">Kembali</a>

        </form>

    </div>
</div>

@endsection
