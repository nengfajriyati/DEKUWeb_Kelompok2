@extends('layouts.admin')

@section('page-title', 'Pengeluaran')

@section('content')

@if(session('success'))
<script>
Swal.fire({
    icon: 'success',
    title: 'Berhasil',
    text: '{{ session('success') }}',
    timer: 2000,
    showConfirmButton: false
});
</script>
@endif

<div class="card shadow-sm">
    <div class="card-body">
        <a href="{{ route('expense.create') }}" class="btn btn-danger mb-3">
            <i class="bi bi-plus-circle"></i> Tambah Pengeluaran
        </a>

        <table class="table table-hover align-middle">
            <thead class="table-dark text-center">
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Dompet</th>
                    <th>Nominal</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            @forelse($expenses as $expense)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $expense->created_at->format('d M Y') }}</td>
                    <td>{{ $expense->wallet->name }}</td>
                    <td class="text-danger fw-bold">
                        - Rp {{ number_format($expense->amount,0,',','.') }}
                    </td>
                    <td>{{ $expense->description ?? '-' }}</td>
                    <td>
                        <a href="{{ route('expense.edit',$expense->id) }}"
                           class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil"></i>
                        </a>

                        <button onclick="hapus({{ $expense->id }})"
                                class="btn btn-danger btn-sm">
                            <i class="bi bi-trash"></i>
                        </button>

                        <form id="hapus-{{ $expense->id }}"
                              action="{{ route('expense.destroy',$expense->id) }}"
                              method="POST">
                            @csrf
                            @method('DELETE')
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

<script>
function hapus(id){
    Swal.fire({
        title: 'Yakin hapus?',
        text: 'Data tidak bisa dikembalikan',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, hapus'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('hapus-'+id).submit();
        }
    });
}
</script>

@endsection
