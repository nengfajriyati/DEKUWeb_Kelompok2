@extends('layouts.admin')

@section('page-title', 'Reminder')

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

<div class="d-flex justify-content-between mb-3">
    <h4 class="fw-bold">
        <i class="bi bi-bell text-warning me-1"></i> Reminder
    </h4>
    <a href="{{ route('reminder.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Reminder
    </a>
</div>

<div class="card">
    <div class="card-body p-0">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Tanggal</th>
                    <th>Catatan</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reminders as $reminder)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $reminder->title }}</td>
                    <td>{{ date('d M Y', strtotime($reminder->date)) }}</td>
                    <td>{{ $reminder->note ?? '-' }}</td>
                    <td class="text-center">
                        <a href="{{ route('reminder.edit', $reminder->id) }}"
                           class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil-square"></i>
                        </a>

                        <form action="{{ route('reminder.destroy', $reminder->id) }}"
                              method="POST"
                              class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="button"
                                    class="btn btn-danger btn-sm btn-delete">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted py-3">
                        Belum ada reminder
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
document.querySelectorAll('.btn-delete').forEach(btn => {
    btn.addEventListener('click', function () {
        const form = this.closest('form');
        Swal.fire({
            title: 'Yakin hapus?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});
</script>

@endsection
