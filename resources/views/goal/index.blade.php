@extends('layouts.admin')

@section('page-title', 'Goals')

@section('content')
<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-semibold">
            <i class="bi bi-bullseye text-primary me-1"></i> Goals
        </h4>
        <a href="{{ route('goal.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Tambah Goal
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="50" class="text-center">No</th>
                        <th>
                            <i class="bi bi-card-text me-1"></i> Judul
                        </th>
                        <th>
                            <i class="bi bi-cash-stack me-1"></i> Target
                        </th>
                        <th>
                            <i class="bi bi-calendar-event me-1"></i> Deadline
                        </th>
                        <th width="140" class="text-center">
                            <i class="bi bi-gear me-1"></i> Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($goals as $goal)
                    <tr>
                        <td class="text-center fw-semibold">
                            {{ $loop->iteration }}
                        </td>
                        <td>{{ $goal->title }}</td>
                        <td>
                            Rp {{ number_format($goal->target_amount,0,',','.') }}
                        </td>
                        <td>
                            {{ $goal->deadline ? date('d M Y', strtotime($goal->deadline)) : '-' }}
                        </td>
                        <td class="text-center">

                            <a href="{{ route('goal.edit', $goal->id) }}"
                               class="btn btn-warning btn-sm me-1"
                               title="Edit">
                                <i class="bi bi-pencil-square"></i>
                            </a>

                            <form action="{{ route('goal.destroy', $goal->id) }}"
                                  method="POST"
                                  class="d-inline delete-form">
                                @csrf
                                @method('DELETE')

                                <button type="button"
                                        class="btn btn-danger btn-sm btn-delete"
                                        title="Hapus">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </form>

                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">
                            <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                            Belum ada goal
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- SWEETALERT SUCCESS --}}
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

{{-- SWEETALERT DELETE --}}
<script>
document.querySelectorAll('.btn-delete').forEach(btn => {
    btn.addEventListener('click', function () {
        Swal.fire({
            title: 'Yakin?',
            text: 'Goal ini akan dihapus permanen!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                this.closest('form').submit();
            }
        });
    });
});
</script>
@endsection
