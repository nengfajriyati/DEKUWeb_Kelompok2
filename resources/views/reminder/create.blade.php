@extends('layouts.admin')

@section('page-title', 'Tambah Reminder')

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

<div class="card shadow-sm">
    <div class="card-body">

        <form action="{{ route('reminder.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>Judul Reminder</label>
                <input type="text" name="title" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Tanggal Pengingat</label>
                <input type="date" name="date" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Catatan</label>
                <textarea name="note" class="form-control"></textarea>
            </div>

            <button class="btn btn-warning">Simpan</button>
            <a href="{{ route('reminder.index') }}" class="btn btn-secondary">Kembali</a>
        </form>

    </div>
</div>
@endsection
