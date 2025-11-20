@extends('layouts.admin')

@section('page-title', 'Dashboard')

@section('content')

<div class="row row-cards">

    <div class="col-md-4">
        <div class="card card-stacked">
            <div class="card-body">
                <h4 class="card-title text-success">Total Pemasukan</h4>
                <p class="text-h2">Rp {{ number_format($totalIncome) }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card card-stacked">
            <div class="card-body">
                <h4 class="card-title text-danger">Total Pengeluaran</h4>
                <p class="text-h2">Rp {{ number_format($totalExpense) }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card card-stacked">
            <div class="card-body">
                <h4 class="card-title text-primary">Saldo Dompet</h4>
                <p class="text-h2">Rp {{ number_format($walletBalance) }}</p>
            </div>
        </div>
    </div>

</div>

<div class="card mt-4">
    <div class="card-body">
        <h3 class="card-title">Grafik Pemasukan vs Pengeluaran</h3>
        <canvas id="financeChart" height="80"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
new Chart(document.getElementById('financeChart'), {
    type: 'bar',
    data: {
        labels: ['Pemasukan', 'Pengeluaran'],
        datasets: [{
            label: 'Nominal',
            data: [{{ $totalIncome }}, {{ $totalExpense }}],
            borderWidth: 2
        }]
    }
});
</script>

@endsection
