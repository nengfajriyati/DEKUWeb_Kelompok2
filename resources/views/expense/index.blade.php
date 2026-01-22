@extends('layouts.admin')

@section('page-title', 'Pengeluaran')

@section('content')

<div class="d-flex justify-content-between mb-3">
    <h4 class="fw-bold">Data Pengeluaran</h4>
    <a href="{{ route('expense.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Pengeluaran
    </a>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card">
    <div class="card-body">

        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Nominal</th>
                    <th>Keterangan</th>
                    <th>Tanggal</th>
                    <th width="150">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($expenses as $expense)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>Rp {{ number_format($expense->amount) }}</td>
                    <td>{{ $expense->notes }}</td>
                    <td>{{ $expense->created_at->format('d M Y') }}</td>
                    <td>
                        <a href="{{ route('expense.edit', $expense->id) }}" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil"></i>
                        </a>

                        <form action="{{ route('expense.destroy', $expense->id) }}" class="d-inline" method="POST">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Yakin hapus?')" class="btn btn-danger btn-sm">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">
                        Belum ada Pengeluaran.
                    </td>
                </tr>
                @endforelse
            </tbody>

        </table>

    </div>
</div>

@endsection
