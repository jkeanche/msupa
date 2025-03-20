@extends('admin.layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Dashboard</h1>
    
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
        <div class="bg-blue-600 text-white rounded-lg shadow-md overflow-hidden">
            <div class="p-4">
                <h5 class="font-medium text-lg">Total Sales</h5>
                <h2 class="text-4xl font-bold my-2">{{ $totalSales ?? 0 }}</h2>
                <p class="text-blue-100">Total revenue generated</p>
            </div>
            <div class="px-4 py-2 bg-blue-700 flex justify-between items-center">
                <span>View Details</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </div>
        </div>
        
        <div class="bg-green-600 text-white rounded-lg shadow-md overflow-hidden">
            <div class="p-4">
                <h5 class="font-medium text-lg">Orders</h5>
                <h2 class="text-4xl font-bold my-2">{{ $totalOrders ?? 0 }}</h2>
                <p class="text-green-100">Total orders placed</p>
            </div>
            <div class="px-4 py-2 bg-green-700 flex justify-between items-center">
                <span>View Details</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </div>
        </div>
        
        <div class="bg-cyan-600 text-white rounded-lg shadow-md overflow-hidden">
            <div class="p-4">
                <h5 class="font-medium text-lg">Products</h5>
                <h2 class="text-4xl font-bold my-2">{{ $totalProducts ?? 0 }}</h2>
                <p class="text-cyan-100">Total products listed</p>
            </div>
            <div class="px-4 py-2 bg-cyan-700 flex justify-between items-center">
                <span>View Details</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </div>
        </div>
        
        <div class="bg-amber-500 text-white rounded-lg shadow-md overflow-hidden">
            <div class="p-4">
                <h5 class="font-medium text-lg">Users</h5>
                <h2 class="text-4xl font-bold my-2">{{ $totalUsers ?? 0 }}</h2>
                <p class="text-amber-100">Registered users</p>
            </div>
            <div class="px-4 py-2 bg-amber-600 flex justify-between items-center">
                <span>View Details</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </div>
        </div>
    </div>
    
    <!-- Recent Orders and User Activity -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="md:col-span-2">
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="px-4 py-3 border-b border-gray-200">
                    <h5 class="font-medium text-lg">Recent Orders</h5>
                </div>
                <div class="p-4">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order ID</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($recentOrders ?? [] as $order)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $order->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $order->user->name ?? 'Guest' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{ $order->status == 'completed' ? 'bg-green-100 text-green-800' : 
                                               ($order->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800') }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $order->created_at->format('M d, Y') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $order->total }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">No recent orders found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="px-4 py-3 bg-gray-50 text-right">
                    <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        View All Orders
                    </a>
                </div>
            </div>
        </div>
        
        <!-- User Activity -->
        <div>
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="px-4 py-3 border-b border-gray-200">
                    <h5 class="font-medium text-lg">Recent User Activity</h5>
                </div>
                <div class="p-4">
                    <ul class="divide-y divide-gray-200">
                        @forelse($userActivities ?? [] as $activity)
                        <li class="py-3 flex justify-between">
                            <div>
                                <p class="font-medium text-gray-900">{{ $activity->user->name }}</p>
                                <p class="text-sm text-gray-500">{{ $activity->description }}</p>
                            </div>
                            <div class="text-xs text-gray-500">{{ $activity->created_at->diffForHumans() }}</div>
                        </li>
                        @empty
                        <li class="py-3 text-center text-gray-500">No recent activity</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Sales Chart -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="px-4 py-3 border-b border-gray-200">
            <h5 class="font-medium text-lg">Sales Overview</h5>
        </div>
        <div class="p-4 h-80">
            <canvas id="salesChart"></canvas>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($chartLabels ?? ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun']) !!},
                datasets: [{
                    label: 'Sales',
                    data: {!! json_encode($chartData ?? [12, 19, 3, 5, 2, 3]) !!},
                    backgroundColor: 'rgba(59, 130, 246, 0.2)',
                    borderColor: 'rgba(59, 130, 246, 1)',
                    borderWidth: 1,
                    tension: 0.4
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                responsive: true,
                maintainAspectRatio: false
            }
        });
    });
</script>
@endsection
