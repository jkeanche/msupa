@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
    </ol>
</nav>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="card mb-4">
                <div class="card-body d-flex align-items-center">
                    <div class="bg-primary text-white p-3 rounded me-3">
                        <i class="fa fa-shopping-cart fa-2x"></i>
                    </div>
                    <div>
                        <h6 class="card-title">Total Orders</h6>
                        <h2 class="mb-0">{{ $totalOrders ?? 0 }}</h2>
                    </div>
                </div>
                <div class="card-footer bg-light">
                    <a href="{{ route('admin.orders.index') }}" class="text-decoration-none">View Details <i class="fa fa-arrow-right ms-1"></i></a>
                </div>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6">
            <div class="card mb-4">
                <div class="card-body d-flex align-items-center">
                    <div class="bg-success text-white p-3 rounded me-3">
                        <i class="fa fa-users fa-2x"></i>
                    </div>
                    <div>
                        <h6 class="card-title">Total Users</h6>
                        <h2 class="mb-0">{{ $totalUsers ?? 0 }}</h2>
                    </div>
                </div>
                <div class="card-footer bg-light">
                    <a href="{{ route('admin.users.index') }}" class="text-decoration-none">View Details <i class="fa fa-arrow-right ms-1"></i></a>
                </div>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6">
            <div class="card mb-4">
                <div class="card-body d-flex align-items-center">
                    <div class="bg-warning text-white p-3 rounded me-3">
                        <i class="fa fa-box fa-2x"></i>
                    </div>
                    <div>
                        <h6 class="card-title">Total Products</h6>
                        <h2 class="mb-0">{{ $totalProducts ?? 0 }}</h2>
                    </div>
                </div>
                <div class="card-footer bg-light">
                    <a href="{{ route('admin.products.index') }}" class="text-decoration-none">View Details <i class="fa fa-arrow-right ms-1"></i></a>
                </div>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6">
            <div class="card mb-4">
                <div class="card-body d-flex align-items-center">
                    <div class="bg-info text-white p-3 rounded me-3">
                        <i class="fa fa-money-bill fa-2x"></i>
                    </div>
                    <div>
                        <h6 class="card-title">Revenue</h6>
                        <h2 class="mb-0">Ksh {{ number_format($totalRevenue ?? 0) }}</h2>
                    </div>
                </div>
                <div class="card-footer bg-light">
                    <a href="{{ route('admin.reports.sales') }}" class="text-decoration-none">View Details <i class="fa fa-arrow-right ms-1"></i></a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title">Recent Orders</h5>
                </div>
                <div class="card-body">
                    @if(isset($recentOrders) && count($recentOrders))
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Customer</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Total</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentOrders as $order)
                                    <tr>
                                        <td>#{{ $order->id }}</td>
                                        <td>{{ $order->user->name }}</td>
                                        <td>
                                            <span class="badge bg-{{ $order->status_color }}">{{ $order->status }}</span>
                                        </td>
                                        <td>{{ $order->created_at->format('M d, Y') }}</td>
                                        <td>Ksh {{ number_format($order->total) }}</td>
                                        <td>
                                            <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-info">View</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-center">No recent orders found.</p>
                    @endif
                </div>
                <div class="card-footer">
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-primary">View All Orders</a>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title">Recent Users</h5>
                </div>
                <div class="card-body">
                    @if(isset($recentUsers) && count($recentUsers))
                        <ul class="list-group list-group-flush">
                            @foreach($recentUsers as $user)
                            <li class="list-group-item d-flex align-items-center">
                                <img src="{{ $user->avatar ?? asset('images/default-avatar.png') }}" class="rounded-circle me-3" width="40" height="40">
                                <div>
                                    <h6 class="mb-0">{{ $user->name }}</h6>
                                    <small class="text-muted">{{ $user->email }}</small>
                                </div>
                                <div class="ms-auto">
                                    <span class="badge bg-secondary">{{ $user->created_at->diffForHumans() }}</span>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-center">No recent users found.</p>
                    @endif
                </div>
                <div class="card-footer">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-primary">View All Users</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Add any dashboard charts or scripts here
</script>
@endpush
