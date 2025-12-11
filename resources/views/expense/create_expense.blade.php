@extends('layouts.admin')

@section('page-title', 'Tambah Pengeluaran')

@section('content')

<div class="card">
    <div class="card-body">

        <form action="{{ route('expense.store') }}" method="POST">
            @csrf

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
