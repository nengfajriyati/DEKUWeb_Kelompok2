@extends('layouts.admin')

@section('page-title', 'Edit Goal')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('goal.update', $goal->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Judul</label>
                    <input type="text" name="title" class="form-control" value="{{ $goal->title }}" required>
                </div>

                <div class="mb-3">
                    <label>Target Nominal</label>
                    <input type="number" name="target_amount" class="form-control"
                           value="{{ $goal->target_amount }}" min="1" required>
                </div>

                <div class="mb-3">
                    <label>Deadline</label>
                    <input type="date" name="deadline" class="form-control"
                           value="{{ $goal->deadline }}">
                </div>

                <button class="btn btn-warning">Update</button>
                <a href="{{ route('goal.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
