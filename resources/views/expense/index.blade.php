@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-3">
        <h4>💸 Pengeluaran</h4>
        <a href="{{ route('expense.create') }}" class="btn btn-danger">
            <i class="bi bi-plus-circle"></i> Tambah Pengeluaran
        </a>
    </div>

    @if(session('success'))
        <script>
            Swal.fire('Berhasil!', '{{ session('success') }}', 'success');
        </script>
    @endif

    @if(session('error'))
        <script>
            Swal.fire('Gagal!', '{{ session('error') }}', 'error');
        </script>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Dompet</th>
                        <th>Nominal</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($expenses as $expense)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $expense->created_at->format('d M Y') }}</td>
                            <td>{{ $expense->wallet->name ?? '-' }}</td>
                            <td class="text-danger fw-bold">
                                - Rp {{ number_format($expense->amount,0,',','.') }}
                            </td>
                            <td>{{ $expense->description ?? '-' }}</td>
                            <td>
                                <a href="{{ route('expense.edit',$expense->id) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                <form action="{{ route('expense.destroy',$expense->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger btn-delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Belum ada pengeluaran</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
document.querySelectorAll('.btn-delete').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Yakin?',
            text: 'Data akan dihapus!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus',
        }).then((result) => {
            if (result.isConfirmed) {
                this.closest('form').submit();
            }
        });
    });
});
</script>
@endsection
