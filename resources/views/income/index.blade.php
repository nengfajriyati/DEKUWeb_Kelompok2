@extends('layouts.admin')

@section('page-title', 'Pemasukan')

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

<div class="card">
    <div class="card-body">

        <a href="{{ route('income.create') }}" class="btn btn-primary mb-3">
            <i class="bi bi-plus-circle"></i> Tambah Pemasukan
        </a>

        <table class="table table-hover align-middle">
            <thead class="table-light text-center">
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Dompet</th>
                    <th>Keterangan</th>
                    <th>Nominal</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
            @forelse($incomes as $income)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>

                    <td>
                        {{ $income->date ? $income->date->format('d M Y') : '-' }}
                    </td>

                    <td>{{ $income->wallet->name ?? '-' }}</td>
                    <td>{{ $income->description }}</td>

                    <td class="text-success fw-bold">
                        Rp {{ number_format($income->amount,0,',','.') }}
                    </td>

                    <td class="text-center">
                        <a href="{{ route('income.edit', $income->id) }}"
                           class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil-square"></i>
                        </a>

                        <button onclick="hapus({{ $income->id }})"
                                class="btn btn-danger btn-sm">
                            <i class="bi bi-trash-fill"></i>
                        </button>

                        <form id="hapus-{{ $income->id }}"
                              method="POST"
                              action="{{ route('income.destroy', $income->id) }}">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">
                        Belum ada pemasukan
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
