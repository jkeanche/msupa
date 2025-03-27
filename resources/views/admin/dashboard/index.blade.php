@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Dashboard Overview</h1>
        <p class="mt-2 text-gray-600">Welcome back, {{ auth()->user()->name }}</p>
    </div>
    
    <!-- Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Sales Card -->
        <div class="bg-gradient-to-br from-blue-600 to-blue-700 rounded-xl shadow-lg overflow-hidden">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="rounded-full bg-blue-500 bg-opacity-30 p-3">
                        <i class="fas fa-dollar-sign text-2xl text-white"></i>
                    </div>
                    <div class="flex items-center text-blue-100">
                        <span class="text-sm mr-1">+{{ $salesGrowth ?? '0' }}%</span>
                        <i class="fas fa-arrow-up"></i>
                    </div>
                </div>
                <h3 class="text-white text-4xl font-bold mb-2">{{ number_format($totalSales ?? 0) }}</h3>
                <p class="text-blue-100">Total Revenue</p>
            </div>
        </div>

        <!-- Orders Card -->
        <div class="bg-gradient-to-br from-emerald-600 to-emerald-700 rounded-xl shadow-lg overflow-hidden">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="rounded-full bg-emerald-500 bg-opacity-30 p-3">
                        <i class="fas fa-shopping-cart text-2xl text-white"></i>
                    </div>
                    <div class="flex items-center text-emerald-100">
                        <span class="text-sm mr-1">{{ $orderGrowth ?? '0' }}%</span>
                        <i class="fas fa-chart-line"></i>
                    </div>
                </div>
                <h3 class="text-white text-4xl font-bold mb-2">{{ number_format($totalOrders ?? 0) }}</h3>
                <p class="text-emerald-100">Total Orders</p>
            </div>
        </div>

        <!-- Products Card -->
        <div class="bg-gradient-to-br from-purple-600 to-purple-700 rounded-xl shadow-lg overflow-hidden">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="rounded-full bg-purple-500 bg-opacity-30 p-3">
                        <i class="fas fa-box text-2xl text-white"></i>
                    </div>
                    <div class="flex items-center text-purple-100">
                        <span class="text-sm">{{ $totalProducts ?? 0 }}</span>
                    </div>
                </div>
                <h3 class="text-white text-4xl font-bold mb-2">{{ $activeProducts ?? 0 }}</h3>
                <p class="text-purple-100">Active Products</p>
            </div>
        </div>

        <!-- Users Card -->
        <div class="bg-gradient-to-br from-amber-500 to-amber-600 rounded-xl shadow-lg overflow-hidden">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="rounded-full bg-amber-400 bg-opacity-30 p-3">
                        <i class="fas fa-users text-2xl text-white"></i>
                    </div>
                    <div class="flex items-center text-amber-100">
                        <span class="text-sm mr-1">+{{ $newUsers ?? 0 }}</span>
                        <span class="text-xs">today</span>
                    </div>
                </div>
                <h3 class="text-white text-4xl font-bold mb-2">{{ number_format($totalUsers ?? 0) }}</h3>
                <p class="text-amber-100">Total Users</p>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <!-- Sales Chart -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="flex items-center justify-between p-6 border-b">
                <h3 class="text-lg font-semibold text-gray-900">Sales Overview</h3>
                <div class="flex space-x-2">
                    <button class="px-3 py-1 text-sm rounded-full bg-blue-100 text-blue-600">Weekly</button>
                    <button class="px-3 py-1 text-sm rounded-full text-gray-600 hover:bg-gray-100">Monthly</button>
                </div>
            </div>
            <div class="p-6">
                <canvas id="salesChart" class="w-full h-64"></canvas>
            </div>
        </div>

        <!-- Orders by Status -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="flex items-center justify-between p-6 border-b">
                <h3 class="text-lg font-semibold text-gray-900">Orders by Status</h3>
                <button class="text-blue-600 hover:text-blue-700">
                    <i class="fas fa-download"></i>
                </button>
            </div>
            <div class="p-6">
                <canvas id="ordersChart" class="w-full h-64"></canvas>
            </div>
        </div>
    </div>

    <!-- Recent Activity Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Recent Orders -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="flex items-center justify-between p-6 border-b">
                    <h3 class="text-lg font-semibold text-gray-900">Recent Orders</h3>
                    <a href="{{ route('admin.orders.index') }}" class="text-blue-600 hover:text-blue-700">View All</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Order</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Customer</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Amount</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($recentOrders ?? [] as $order)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#{{ $order->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <div class="flex items-center">
                                        <img class="h-8 w-8 rounded-full mr-3" src="{{ $order->user->avatar ?? asset('images/default-avatar.png') }}" alt="">
                                        {{ $order->user->name ?? 'Guest' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        {{ $order->status == 'completed' ? 'bg-green-100 text-green-800' : 
                                           ($order->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                                           ($order->status == 'processing' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800')) }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $order->total }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $order->created_at->format('M d, Y') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">No recent orders found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="flex items-center justify-between p-6 border-b">
                    <h3 class="text-lg font-semibold text-gray-900">Recent Activity</h3>
                    <button class="text-gray-400 hover:text-gray-500">
                        <i class="fas fa-ellipsis-v"></i>
                    </button>
                </div>
                <div class="p-6">
                    <div class="flow-root">
                        <ul class="-mb-8">
                            @forelse($userActivities ?? [] as $activity)
                            <li>
                                <div class="relative pb-8">
                                    @if(!$loop->last)
                                    <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                                    @endif
                                    <div class="relative flex space-x-3">
                                        <div>
                                            <span class="h-8 w-8 rounded-full bg-blue-500 flex items-center justify-center ring-8 ring-white">
                                                <i class="fas fa-user-circle text-white"></i>
                                            </span>
                                        </div>
                                        <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                            <div>
                                                <p class="text-sm text-gray-500">{{ $activity->description }}</p>
                                            </div>
                                            <div class="text-right text-sm whitespace-nowrap text-gray-500">
                                                <time>{{ $activity->created_at->diffForHumans() }}</time>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @empty
                            <li class="text-center text-gray-500 py-4">No recent activity</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Sales Chart
    const salesCtx = document.getElementById('salesChart').getContext('2d');
    new Chart(salesCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode($chartLabels ?? array_map(function($i) { return 'Week ' . $i; }, range(1, 7))) !!},
            datasets: [{
                label: 'Sales',
                data: {!! json_encode($chartData ?? [65, 59, 80, 81, 56, 55, 40]) !!},
                fill: true,
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                borderColor: 'rgb(59, 130, 246)',
                tension: 0.4,
                pointRadius: 4,
                pointBackgroundColor: 'rgb(59, 130, 246)'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        display: true,
                        drawBorder: false
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });

    // Orders Chart
    const ordersCtx = document.getElementById('ordersChart').getContext('2d');
    new Chart(ordersCtx, {
        type: 'doughnut',
        data: {
            labels: ['Completed', 'Pending', 'Processing', 'Cancelled'],
            datasets: [{
                data: {!! json_encode($orderStatusData ?? [30, 20, 25, 15]) !!},
                backgroundColor: [
                    'rgb(34, 197, 94)',
                    'rgb(234, 179, 8)',
                    'rgb(59, 130, 246)',
                    'rgb(239, 68, 68)'
                ],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        usePointStyle: true,
                        padding: 20
                    }
                }
            },
            cutout: '75%'
        }
    });
});
</script>
@endsection
