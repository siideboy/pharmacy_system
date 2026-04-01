<?php
// No need for session start here because index.html already started session via AJAX? 
// Actually AJAX calls from index.html will not carry session automatically? They do if session started at the beginning of each page.
// To be safe, include config/database.php which starts session.
require_once '../config/database.php';
if (!isLoggedIn()) exit;
?>
<!-- Quick Actions -->
<div class="quick-actions">
    <button class="btn btn-primary btn-sm" data-action="pos">
        <i class="fas fa-cash-register"></i> POS
    </button>
    <button class="btn btn-outline-primary btn-sm" data-action="verify-purchase">
        <i class="fas fa-check-circle"></i> Verify Purchase
    </button>
    <button class="btn btn-outline-primary btn-sm" data-action="verify-transfer">
        <i class="fas fa-exchange-alt"></i> Verify Transfer
    </button>
    <button class="btn btn-outline-primary btn-sm" data-action="stock-adjust">
        <i class="fas fa-adjust"></i> Stock Adjust
    </button>
    <button class="btn btn-outline-primary btn-sm" data-action="stocks-status">
        <i class="fas fa-boxes"></i> Stocks Status
    </button>
    <button class="btn btn-outline-primary btn-sm" data-action="item-in-out">
        <i class="fas fa-arrows-alt-h"></i> Item IN & OUT
    </button>
    <button class="btn btn-outline-primary btn-sm" data-action="ledger">
        <i class="fas fa-book"></i> Ledger
    </button>
    <button class="btn btn-outline-primary btn-sm" data-action="user-privileges">
        <i class="fas fa-user-lock"></i> User Privileges
    </button>
</div>

<!-- Stats Cards -->
<div class="stats-grid">
    <div class="stats-card">
        <div class="icon text-danger"><i class="fas fa-money-bill-wave"></i></div>
        <div class="value text-danger">Tsh. 0.0/=</div>
        <div class="label">Today Expenses</div>
    </div>
    <div class="stats-card">
        <div class="icon text-success"><i class="fas fa-shopping-cart"></i></div>
        <div class="value text-success">Tsh. 120,000/=</div>
        <div class="label">Today Sales</div>
    </div>
    <div class="stats-card">
        <div class="icon text-warning"><i class="fas fa-exclamation-circle"></i></div>
        <div class="value text-warning">46</div>
        <div class="label">Out of Stock</div>
    </div>
    <div class="stats-card">
        <div class="icon text-dark"><i class="fas fa-calendar-times"></i></div>
        <div class="value text-dark">0</div>
        <div class="label">Expired Items</div>
    </div>
    <div class="stats-card">
        <div class="icon text-info"><i class="fas fa-clock"></i></div>
        <div class="value text-info">Open</div>
        <div class="label">Expiring Soon</div>
    </div>
    <div class="stats-card">
        <div class="icon text-primary"><i class="fas fa-arrows-alt"></i></div>
        <div class="value text-primary">0.0</div>
        <div class="label">Moved Items</div>
    </div>
    <div class="stats-card">
        <div class="icon text-success"><i class="fas fa-chart-line"></i></div>
        <div class="value text-success">Tsh. 0.0/=</div>
        <div class="label">Stock Sales</div>
    </div>
</div>

<!-- Charts Row -->
<div class="row g-3">
    <div class="col-lg-8">
        <div class="chart-container">
            <h5 class="chart-title">Today Income</h5>
            <div class="chart-wrapper">
                <canvas id="incomeChart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="chart-container">
            <h5 class="chart-title">Payment Methods</h5>
            <div class="chart-wrapper">
                <canvas id="paymentChart"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
// Initialize charts
const incomeCtx = document.getElementById('incomeChart')?.getContext('2d');
if (incomeCtx) {
    new Chart(incomeCtx, {
        type: 'bar',
        data: {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Today'],
            datasets: [{
                label: 'Income (TZS)',
                data: [90000, 100000, 110000, 120000, 130000, 110000, 120000],
                backgroundColor: 'rgba(74, 107, 255, 0.7)',
                borderColor: 'rgba(74, 107, 255, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: { y: { beginAtZero: true } }
        }
    });
}
const paymentCtx = document.getElementById('paymentChart')?.getContext('2d');
if (paymentCtx) {
    new Chart(paymentCtx, {
        type: 'doughnut',
        data: {
            labels: ['Cash', 'M-Pesa', 'Airtel Money'],
            datasets: [{
                data: [55, 30, 15],
                backgroundColor: ['#4a6bff', '#28a745', '#17a2b8']
            }]
        },
        options: { responsive: true, maintainAspectRatio: false }
    });
}
</script>