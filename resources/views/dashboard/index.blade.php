@extends('layouts.admin')

@section('page-title', 'Dashboard')

@section('content')

<div class="row g-4">

    <div class="col-md-4">
        <div class="card p-4 position-relative">
            <i class="bi bi-arrow-down-circle-fill stat-icon text-success"></i>
            <h6 class="text-success fw-semibold">Total Pemasukan</h6>
            <h3 class="fw-bold">Rp {{ number_format($totalIncome) }}</h3>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card p-4 position-relative">
            <i class="bi bi-arrow-up-circle-fill stat-icon text-danger"></i>
            <h6 class="text-danger fw-semibold">Total Pengeluaran</h6>
            <h3 class="fw-bold">Rp {{ number_format($totalExpense) }}</h3>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card p-4 position-relative">
            <i class="bi bi-wallet-fill stat-icon text-primary"></i>
            <h6 class="text-primary fw-semibold">Saldo Dompet</h6>
            <h3 class="fw-bold">Rp {{ number_format($walletBalance) }}</h3>
        </div>
    </div>

</div>

<div class="card mt-5 p-4">
    <h5 class="fw-semibold mb-3">Grafik Keuangan</h5>
    <canvas id="financeChart" height="90"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
new Chart(document.getElementById('financeChart'), {
    type: 'bar',
    data: {
        labels: ['Pemasukan', 'Pengeluaran'],
        datasets: [{
            data: [{{ $totalIncome }}, {{ $totalExpense }}],
            backgroundColor: ['#38b000', '#d00000'],
            borderRadius: 8
        }]
    },
    options: {
        plugins: {
            legend: { display: false }
        }
    }
});

// SWEETALERT WELCOME
Swal.fire({
    title: 'Selamat Datang 👋',
    text: 'Kelola keuanganmu dengan lebih rapi bersama DEKU',
    icon: 'success',
    timer: 2200,
    showConfirmButton: false
});
</script>

@endsection
