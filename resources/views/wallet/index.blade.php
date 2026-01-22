@extends('layouts.admin')

@section('page-title', 'Dompet')

@section('content')

{{-- ALERT --}}
@if (session('success'))
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

@if (session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Gagal',
        text: '{{ session('error') }}'
    });
</script>
@endif

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold">
        <i class="bi bi-gem text-primary me-2"></i> Daftar Dompet
    </h4>

    <a href="{{ route('wallet.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-1"></i> Tambah Dompet
    </a>
</div>

<div class="row">
@forelse($wallets as $wallet)
    <div class="col-md-4 mb-4">
        <div class="card shadow-sm border-0 h-100 wallet-card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h5 class="fw-semibold mb-0">
                        <i class="bi bi-wallet2 text-info me-2"></i>
                        {{ $wallet->name }}
                    </h5>
                    <span class="badge bg-success">Aktif</span>
                </div>

                <p class="text-muted mb-3">Saldo Saat Ini</p>
                <h3 class="fw-bold text-dark">
                    Rp {{ number_format($wallet->balance, 0, ',', '.') }}
                </h3>

                <hr>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('wallet.edit', $wallet->id) }}"
                       class="btn btn-warning btn-sm">
                        <i class="bi bi-pencil-square"></i> Edit
                    </a>

                    <form action="{{ route('wallet.destroy', $wallet->id) }}"
                          method="POST"
                          class="delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="button"
                                class="btn btn-danger btn-sm btn-delete">
                            <i class="bi bi-trash"></i> Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@empty
    <div class="col-12">
        <div class="alert alert-secondary text-center">
            Belum ada dompet. Yuk tambah dulu 💎
        </div>
    </div>
@endforelse
</div>

{{-- SWEETALERT --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.querySelectorAll('.btn-delete').forEach(btn => {
    btn.addEventListener('click', function () {
        const form = this.closest('form');

        Swal.fire({
            title: 'Yakin hapus dompet?',
            text: 'Dompet akan dihapus permanen',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});
</script>

<style>
.wallet-card {
    transition: all 0.3s ease;
}
.wallet-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 12px 25px rgba(0,0,0,0.08);
}
</style>

@endsection
