@extends('layouts.admin')

@section('page-title', 'Pemasukan')

@section('content')

<div class="d-flex justify-content-between mb-3">
    <h4 class="fw-bold">Data Pemasukan</h4>
    <a href="{{ route('income.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Pemasukan
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
                @forelse($incomes as $income)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>Rp {{ number_format($income->amount) }}</td>
                    <td>{{ $income->description }}</td>
                    <td>{{ $income->created_at->format('d M Y') }}</td>
                    <td>
                        <a href="{{ route('income.edit', $income->id) }}" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil"></i>
                        </a>

                        <form action="{{ route('income.destroy', $income->id) }}" class="d-inline" method="POST">
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
                        Belum ada pemasukan.
                    </td>
                </tr>
                @endforelse
            </tbody>

        </table>

    </div>
</div>

@endsection
