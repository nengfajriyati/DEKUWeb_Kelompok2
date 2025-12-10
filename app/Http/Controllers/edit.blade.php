@extends('layouts.admin')

{{-- Mengatur Judul Halaman --}}
@section('title', 'Edit Dompet')

@section('content')
<div class="container-fluid">

    {{-- Page Heading --}}
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">@yield('title')</h1>
    </div>

    {{-- Form --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulir Edit Dompet</h6>
        </div>
        <div class="card-body">
            {{-- Tampilkan error validasi --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('wallet.update', $wallet->id) }}" method="POST">
                @csrf
                @method('PUT') {{-- Method spoofing untuk update --}}

                <div class="mb-3">
                    <label for="name" class="form-label">Nama Dompet</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $wallet->name) }}" required autofocus>
                </div>
                <div class="mb-3">
                    <label for="balance" class="form-label">Saldo</label>
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="number" class="form-control @error('balance') is-invalid @enderror" id="balance" name="balance" value="{{ old('balance', $wallet->balance) }}" required min="0" step="1000">
                    </div>
                </div>
                <div class="d-flex justify-content-end pt-3">
                    <a href="{{ route('wallet.index') }}" class="btn btn-secondary me-2">Kembali</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection