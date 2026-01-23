@extends('layouts.admin')

@section('page-title', 'Tambah Goals')

@section('content')

@if ($errors->any())
<script>
Swal.fire({
    icon: 'error',
    title: 'Gagal',
    text: '{{ $errors->first() }}'
});
</script>
@endif

<div class="card shadow-sm border-0">
    <div class="card-body">

        <h4 class="fw-bold mb-4">🎯 Tambah Goals</h4>

        <form action="{{ route('goal.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nama Goals</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Target Nominal</label>
            <input type="number" name="target_amount" min="1" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Deadline</label>
            <input type="date" name="deadline" class="form-control">
        </div>

        <button class="btn btn-primary">Simpan</button>
        </form>


    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@endsection
