@extends('layouts.admin')

@section('page-title', 'Tambah Goal')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('goal.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label>Judul</label>
                    <input type="text" name="title" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Target Nominal</label>
                    <input type="number" name="target_amount" class="form-control" min="1" required>
                </div>

                <div class="mb-3">
                    <label>Deadline</label>
                    <input type="date" name="deadline" class="form-control">
                </div>

                <button class="btn btn-primary">Simpan</button>
                <a href="{{ route('goal.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
