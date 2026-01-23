@extends('layouts.admin')

@section('page-title', 'Edit Reminder')

@section('content')

<div class="card shadow-sm">
    <div class="card-body">

        <form action="{{ route('reminder.update', $reminder->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Judul</label>
                <input type="text"
                       name="title"
                       value="{{ $reminder->title }}"
                       class="form-control"
                       required>
            </div>

            <div class="mb-3">
                <label>Tanggal</label>
                <input type="date"
                       name="date"
                       value="{{ $reminder->date->format('Y-m-d') }}"
                       class="form-control"
                       required>
            </div>

            <div class="mb-3">
                <label>Catatan</label>
                <textarea name="note"
                          class="form-control">{{ $reminder->note }}</textarea>
            </div>

            <button class="btn btn-warning">Update</button>
            <a href="{{ route('reminder.index') }}" class="btn btn-secondary">Kembali</a>
        </form>

    </div>
</div>
@endsection
