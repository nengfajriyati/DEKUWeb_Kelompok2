@extends('layouts.admin')

@section('page-title', 'Dompet')

@section('content')

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="card">
    <div class="card-body">

        <a href="{{ route('wallet.create') }}" class="btn btn-primary mb-3">
            <i class="bi bi-plus-circle"></i> Tambah Dompet
        </a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Dompet</th>
                    <th>Saldo</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($wallets as $wallet)
                <tr>
                    <td>{{ $wallet->name }}</td>
                    <td>Rp {{ number_format($wallet->balance, 0, ',', '.') }}</td>
                    <td>
                        <a href="{{ route('wallet.edit', $wallet->id) }}"
                        class="btn btn-warning btn-sm">
                            Edit
                        </a>

                        <form action="{{ route('wallet.destroy', $wallet->id) }}"
                            method="POST"
                            class="d-inline"
                            onsubmit="return confirm('Yakin hapus dompet?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center text-muted">
                        Belum ada dompet
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>


    </div>
</div>

@endsection
