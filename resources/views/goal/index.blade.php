@extends('layouts.admin')

@section('content')
<h4>Goals Keuangan</h4>

<a href="{{ route('goal.create') }}" class="btn btn-primary mb-3">
    + Tambah Goal
</a>

<div class="row">
@foreach($goals as $goal)
<div class="col-md-6 mb-3">
    <div class="card">
        <div class="card-body">

            <h5>{{ $goal->title }}</h5>

            {{-- DEADLINE WARNING --}}
            @if($goal->isNearDeadline())
                <span class="badge bg-warning">Deadline Hampir Habis</span>
            @endif

            <p>
                Rp {{ number_format($goal->current_amount) }} /
                Rp {{ number_format($goal->target_amount) }}
            </p>

            <div class="progress">
                <div class="progress-bar bg-success"
                     style="width: {{ $goal->progress() }}%">
                    {{ $goal->progress() }}%
                </div>
            </div>

        </div>
    </div>
</div>
@endforeach
</div>
@endsection
