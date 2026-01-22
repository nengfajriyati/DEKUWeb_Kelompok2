@extends('layouts.admin')

@section('page-title', 'Tambah Reminder')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('reminder.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label>Judul</label>
                    <input type="text" name="title" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Tanggal</label>
                    <input type="date" name="remind_date" class="form-control" required>
                </div>

                <button class="btn btn-warning">Simpan</button>
                <a href="{{ route('reminder.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
