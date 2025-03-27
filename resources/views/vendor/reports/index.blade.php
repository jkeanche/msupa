@extends('layouts.app')

@section('content')
<div class="px-4 py-5 mx-auto max-w-7xl">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-semibold">Reports & Analytics</h2>
        <div class="relative inline-block text-left" x-data="{ open: false }">
            <button @click="open = !open" type="button" class="inline-flex justify-center items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                <i class="fas fa-download mr-2"></i> Export
                <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
            <div x-show="open" @click.away="open = false" class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none">
                <div class="py-1">
                    <a href="{{ route('vendor.reports.export', ['format' => 'pdf']) }}" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100">PDF</a>
                    <a href="{{ route('vendor.reports.export', ['format' => 'csv']) }}" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100">CSV</a>
                    <a href="{{ route('vendor.reports.export', ['format' => 'excel']) }}" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100">Excel</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Date Range Filter -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form action="{{ route('vendor.reports.index') }}" method="GET" class="row g-3">
                <div class="col-md-4">
                    <label for="date_range" class="form-label">Date Range</label>
                    <select class="form-select" id="date_range" name="date_range">
                        <option value="today" {{ request('date_range') == 'today' ? 'selected' : '' }}>Today</option>
                        <option value="yesterday" {{ request('date_range') == 'yesterday' ? 'selected' : '' }}>Yesterday</option>
                        <option value="last7days" {{ request('date_range', 'last7days') == 'last7days' ? 'selected' : '' }}>Last 7 Days</option>
                        <option value="last30days" {{ request('date_range') == 'last30days' ? 'selected' : '' }}>Last 30 Days</option>
                        <option value="thismonth" {{ request('date_range') == 'thismonth' ? 'selected' : '' }}>This Month</option>
                        <option value="lastmonth" {{ request('date_range') == 'lastmonth' ? 'selected' : '' }}>Last Month</option>
                        <option value="custom" {{ request('date_range') == 'custom' ? 'selected' : '' }}>Custom Range</option>
                    </select>
                </div>
                <div class="col-md-3 custom-date-range" style="{{ request('date_range') == 'custom' ? '' : 'display: none;' }}">
                    <label for="start_date" class="form-label">Start Date</label>
                    <input type="date" class="form-control" id="start_date" name="start_date" value="{{ request('start_date') }}">
                </div>
                <div class="col-md-3 custom-date-range" style="{{ request('date_range') == 'custom' ? '' : 'display: none;' }}">
                    <label for="end_date" class="form-label">End Date</label>
                    <input type="date" class="form-control" id="end_date" name="end_date" value="{{ request('end_date') }}">
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">Apply Filter</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white h-100">
                <div class="card-body">
                    <h5 class="card-title">Total Sales</h5>
                    <h2 class="display-4">Ksh.{{ number_format($totalSales ?? 0, 2) }}</h2>
                    <p class="card-text">
                        @if(isset($salesChange) && $salesChange > 0)
                            <span class="text-success"><i class="fas fa-arrow-up"></i> {{ number_format($salesChange, 1) }}%</span>
                        @elseif(isset($salesChange) && $salesChange < 0)
                            <span class="text-danger"><i class="fas fa-arrow-down"></i> {{ number_format(abs($salesChange), 1) }}%</span>
                        @else
                            <span>No change</span>
                        @endif
                        vs previous period
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white h-100">
                <div class="card-body">
                    <h5 class="card-title">Orders</h5>
                    <h2 class="display-4">{{ $totalOrders ?? 0 }}</h2>
                    <p class="card-text">
                        @if(isset($ordersChange) && $ordersChange > 0)
                            <span class="text-success"><i class="fas fa-arrow-up"></i> {{ number_format($ordersChange, 1) }}%</span>
                        @elseif(isset($ordersChange) && $ordersChange < 0)
                            <span class="text-danger"><i class="fas fa-arrow-down"></i> {{ number_format(abs($ordersChange), 1) }}%</span>
                        @else
                            <span>No change</span>
                        @endif
                        vs previous period
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info text-white h-100">
                <div class="card-body">
                    <h5 class="card-title">Average Order Value</h5>
                    <h2 class="display-4">Ksh.{{ number_format($averageOrderValue ?? 0, 2) }}</h2>
                    <p class="card-text">
                        @if(isset($aovChange) && $aovChange > 0)
                            <span class="text-success"><i class="fas fa-arrow-up"></i> {{ number_format($aovChange, 1) }}%</span>
                        @elseif(isset($aovChange) && $aovChange < 0)
                            <span class="text-danger"><i class="fas fa-arrow-down"></i> {{ number_format(abs($aovChange), 1) }}%</span>
                        @else
                            <span>No change</span>
                        @endif
                        vs previous period
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-dark h-100">
                <div class="card-body">
                    <h5 class="card-title">Conversion Rate</h5>
                    <h2 class="display-4">{{ number_format($conversionRate ?? 0, 1) }}%</h2>
                    <p class="card-text">
                        @if(isset($conversionChange) && $conversionChange > 0)
                            <span class="text-success"><i class="fas fa-arrow-up"></i> {{ number_format($conversionChange, 1) }}%</span>
                        @elseif(isset($conversionChange) && $conversionChange < 0)
                            <span class="text-danger"><i class="fas fa-arrow-down"></i> {{ number_format(abs($conversionChange), 1) }}%</span>
                        @else
                            <span>No change</span>
                        @endif
                        vs previous period
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Sales Chart -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Sales Trend</h5>
            <div class="btn-group">
                <button type="button" class="btn btn-sm btn-outline-secondary active" id="daily-chart">Daily</button>
                <button type="button" class="btn btn-sm btn-outline-secondary" id="weekly-chart">Weekly</button>
                <button type="button" class="btn btn-sm btn-outline-secondary" id="monthly-chart">Monthly</button>
            </div>
        </div>
        <div class="card-body">
            <canvas id="salesChart" height="300"></canvas>
        </div>
    </div>

    <div class="row mb-4">
        <!-- Top Products -->
        <div class="col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Top Products</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="py-3">Product</th>
                                    <th class="py-3">Sold</th>
                                    <th class="py-3">Revenue</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($topProducts) && count($topProducts) > 0)
                                    @foreach($topProducts as $product)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if($product->image_url)
                                                    <img src="{{ asset($product->image_url) }}" alt="{{ $product->name }}" class="rounded me-2" width="40" height="40" style="object-fit: cover;">
                                                @else
                                                    <div class="bg-secondary rounded me-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                                        <i class="fas fa-box text-white"></i>
                                                    </div>
                                                @endif
                                                <div>
                                                    <h6 class="mb-0">{{ $product->name }}</h6>
                                                    <small class="text-muted">{{ $product->sku }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $product->quantity_sold }}</td>
                                        <td>Ksh.{{ number_format($product->revenue, 2) }}</td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="3" class="text-center py-4">No product data available</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Order Status -->
        <div class="col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Order Status</h5>
                </div>
                <div class="card-body">
                    <canvas id="orderStatusChart" height="260"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <!-- Sales by Category -->
        <div class="col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Sales by Category</h5>
                </div>
                <div class="card-body">
                    <canvas id="categoryChart" height="260"></canvas>
                </div>
            </div>
        </div>
        
        <!-- Customer Acquisition -->
        <div class="col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Customer Acquisition</h5>
                </div>
                <div class="card-body">
                    <canvas id="customerChart" height="260"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Orders -->
    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <h5 class="mb-0">Recent Orders</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="py-3">Order ID</th>
                            <th class="py-3">Date</th>
                            <th class="py-3">Customer</th>
                            <th class="py-3">Items</th>
                            <th class="py-3">Total</th>
                            <th class="py-3">Status</th>
                            <th class="py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($recentOrders) && count($recentOrders) > 0)
                            @foreach($recentOrders as $order)
                            <tr>
                                <td>#{{ $order->id }}</td>
                                <td>{{ date('M d, Y', strtotime($order->created_at)) }}</td>
                                <td>{{ $order->customer_name }}</td>
                                <td>{{ $order->item_count }}</td>
                                <td>Ksh.{{ number_format($order->total, 2) }}</td>
                                <td>
                                    @php
                                        $statusClass = 'bg-secondary';
                                        switch($order->status) {
                                            case 'pending':
                                                $statusClass = 'bg-warning text-dark';
                                                break;
                                            case 'processing':
                                                $statusClass = 'bg-info text-dark';
                                                break;
                                            case 'shipped':
                                                $statusClass = 'bg-primary';
                                                break;
                                            case 'delivered':
                                                $statusClass = 'bg-success';
                                                break;
                                            case 'cancelled':
                                                $statusClass = 'bg-danger';
                                                break;
                                        }
                                    @endphp
                                    <span class="badge {{ $statusClass }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('vendor.orders.show', $order->id) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7" class="text-center py-4">No recent orders found</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white text-end">
            <a href="{{ route('vendor.orders.index') }}" class="btn btn-outline-primary btn-sm">View All Orders</a>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Date range selector
        const dateRangeSelect = document.getElementById('date_range');
        const customDateFields = document.querySelectorAll('.custom-date-range');
        
        dateRangeSelect.addEventListener('change', function() {
            if (this.value === 'custom') {
                customDateFields.forEach(field => field.style.display = 'block');
            } else {
                customDateFields.forEach(field => field.style.display = 'none');
            }
        });
        
        // Sample data for charts - in a real application, this would come from the backend
        const salesData = {
            daily: {
                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                data: [65, 59, 80, 81, 56, 55, 40]
            },
            weekly: {
                labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
                data: [300, 450, 320, 280]
            },
            monthly: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                data: [1200, 1900, 1500, 1700, 2100, 1800]
            }
        };
        
        // Sales Chart
        const salesChartCtx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(salesChartCtx, {
            type: 'line',
            data: {
                labels: salesData.daily.labels,
                datasets: [{
                    label: 'Sales',
                    data: salesData.daily.data,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 2,
                    tension: 0.1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return '$' + value;
                            }
                        }
                    }
                }
            }
        });
        
        // Chart period buttons
        document.getElementById('daily-chart').addEventListener('click', function() {
            updateSalesChart('daily');
            toggleActiveButton(this);
        });
        
        document.getElementById('weekly-chart').addEventListener('click', function() {
            updateSalesChart('weekly');
            toggleActiveButton(this);
        });
        
        document.getElementById('monthly-chart').addEventListener('click', function() {
            updateSalesChart('monthly');
            toggleActiveButton(this);
        });
        
        function updateSalesChart(period) {
            salesChart.data.labels = salesData[period].labels;
            salesChart.data.datasets[0].data = salesData[period].data;
            salesChart.update();
        }
        
        function toggleActiveButton(button) {
            document.querySelectorAll('.btn-group .btn').forEach(btn => {
                btn.classList.remove('active');
            });
            button.classList.add('active');
        }
        
        // Order Status Chart
        const orderStatusCtx = document.getElementById('orderStatusChart').getContext('2d');
        new Chart(orderStatusCtx, {
            type: 'doughnut',
            data: {
                labels: ['Pending', 'Processing', 'Shipped', 'Delivered', 'Cancelled'],
                datasets: [{
                    data: [12, 19, 8, 15, 5],
                    backgroundColor: [
                        '#ffc107',
                        '#17a2b8',
                        '#007bff',
                        '#28a745',
                        '#dc3545'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                    }
                }
            }
        });
        
        // Category Chart
        const categoryCtx = document.getElementById('categoryChart').getContext('2d');
        new Chart(categoryCtx, {
            type: 'pie',
            data: {
                labels: ['Electronics', 'Clothing', 'Home & Garden', 'Books', 'Other'],
                datasets: [{
                    data: [30, 25, 20, 15, 10],
                    backgroundColor: [
                        '#4e73df',
                        '#1cc88a',
                        '#36b9cc',
                        '#f6c23e',
                        '#858796'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                    }
                }
            }
        });
        
        // Customer Chart
        const customerCtx = document.getElementById('customerChart').getContext('2d');
        new Chart(customerCtx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'New Customers',
                    data: [15, 25, 20, 30, 22, 18],
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }, {
                    label: 'Returning Customers',
                    data: [10, 15, 12, 18, 14, 20],
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>
@endsection
