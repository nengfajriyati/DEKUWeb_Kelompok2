@extends('layouts.admin')

@section('page-title', 'Goals Keuangan')

@section('content')

<a href="{{ route('goal.create') }}" class="btn btn-primary mb-3">
    + Tambah Goals
</a>

<div class="row">
@foreach($goals as $goal)
<div class="col-md-6 mb-3">
    <div class="card">
        <div class="card-body">
            <h5>{{ $goal->title }}</h5>
            @if($goal->deadline && now()->gt($goal->deadline))
    <span class="badge bg-danger">Deadline Terlewat</span>
@endif
            <p>Rp {{ number_format($goal->current_amount) }} /
               Rp {{ number_format($goal->target_amount) }}</p>

            <div class="progress mb-2">
                <div class="progress-bar" style="width: {{ $goal->progress() }}%">
                    {{ $goal->progress() }}%
                </div>
            </div>

            <a href="{{ route('goal.edit', $goal->id) }}" class="btn btn-sm btn-warning">Edit</a>
        </div>
    </div>
</div>
@endforeach


</div>

@endsection
