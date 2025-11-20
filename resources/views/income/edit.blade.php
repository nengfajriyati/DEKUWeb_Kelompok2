@extends('layouts.admin')

@section('page-title', 'Edit Pemasukan')

@section('content')

<div class="card">
    <div class="card-body">

        <form action="{{ route('income.update', $income->id) }}" method="POST">
            @csrf @method('PUT')

            <div class="mb-3">
                <label>Nominal</label>
                <input type="number" name="amount" value="{{ $income->amount }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Keterangan</label>
                <input type="text" name="description" value="{{ $income->description }}" class="form-control" required>
            </div>

            <button class="btn btn-primary">Update</button>
            <a href="{{ route('income.index') }}" class="btn btn-secondary">Kembali</a>

        </form>

    </div>
</div>

@endsection
