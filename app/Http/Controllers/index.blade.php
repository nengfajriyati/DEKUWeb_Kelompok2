@extends('layouts.admin')

{{-- Mengatur Judul Halaman --}}
@section('title', 'Daftar Dompet')

@section('content')
<div class="container-fluid">

    {{-- Page Heading --}}
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        {{-- Judul Halaman --}}
        <h1 class="h3 mb-0 text-gray-800">@yield('title')</h1>
        {{-- Tombol Tambah --}}
        <a href="{{ route('wallet.create') }}" class="btn btn-primary shadow-sm">
            <i class="bi bi-plus-lg me-1"></i>
            Tambah Dompet
        </a>
    </div>

    {{-- Menampilkan Pesan Sukses --}}
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Menampilkan Pesan Error --}}
    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Konten Utama --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Dompet</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama Dompet</th>
                            <th>Saldo Saat Ini</th>
                            <th width="20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Loop data dompet --}}
                        @forelse ($wallets as $wallet)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $wallet->name }}</td>
                                {{-- Format saldo sebagai mata uang Rupiah --}}
                                <td>Rp {{ number_format($wallet->balance, 0, ',', '.') }}</td>
                                <td>
                                    {{-- Tombol Edit --}}
                                    <a href="{{ route('wallet.edit', $wallet->id) }}" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>

                                    {{-- Tombol Hapus (dengan konfirmasi) --}}
                                    <form action="{{ route('wallet.destroy', $wallet->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus dompet ini? Tindakan ini tidak dapat dibatalkan.')">
                                            <i class="bi bi-trash3"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            {{-- Tampilan jika tidak ada data --}}
                            <tr>
                                <td colspan="4" class="text-center py-4">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="bi bi-wallet2 fs-1 text-secondary mb-2"></i>
                                        <p class="mb-0">Belum ada dompet yang ditambahkan.</p>
                                        <small>Silakan tambahkan dompet baru untuk memulai.</small>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection