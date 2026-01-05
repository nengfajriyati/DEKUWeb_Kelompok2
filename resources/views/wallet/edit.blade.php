@extends('layouts.admin')

@section('page-title', 'Edit Dompet')

@section('content')
<div class="card">
    <div class="card-body">

        <form action="{{ route('wallet.update', $wallet->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Nama Dompet</label>
                <input type="text"
                       name="name"
                       class="form-control"
                       value="{{ $wallet->name }}"
                       required>
            </div>

            <button class="btn btn-primary">Update</button>
            <a href="{{ route('wallet.index') }}" class="btn btn-secondary">
                Kembali
            </a>

        </form>

    </div>
</div>
@endsection
