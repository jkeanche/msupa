@extends('admin.layouts.app')

@section('title', 'Orders')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Orders</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="card-title">Orders</h4>
        <div>
            <a href="{{ route('admin.orders.export') }}" class="btn btn-success">
                <i class="fa fa-download me-1"></i> Export
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="mb-3">
            <form action="{{ route('admin.orders.index') }}" method="GET" class="row g-3">
                <div class="col-md-2">
                    <input type="text" name="order_id" class="form-control" placeholder="Order ID" value="{{ request('order_id') }}">
                </div>
                <div class="col-md-3">
                    <input type="text" name="customer" class="form-control" placeholder="Customer name/email" value="{{ request('customer') }}">
                </div>
                <div class="col-md-2">
                    <select name="status" class="form-control">
                        <option value="">All Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Processing</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <div class="input-group">
                        <input type="date" name="date_from" class="form-control" placeholder="From" value="{{ request('date_from') }}">
                        <input type="date" name="date_to" class="form-control" placeholder="To" value="{{ request('date_to') }}">
                    </div>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Filter</button>
                </div>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Customer</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Payment Method</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td>#{{ $order->id }}</td>
                            <td>
                                {{ $order->user->name ?? $order->customer_name }}
                                <br>
                                <small>{{ $order->user->email ?? $order->customer_email }}</small>
                            </td>
                            <td>Ksh {{ number_format($order->total_amount) }}</td>
                            <td>
                                <span class="badge bg-{{ $order->status_color }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td>{{ $order->payment_method }}</td>
                            <td>{{ $order->created_at->format('M d, Y H:i') }}</td>
                            <td>
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-info">
                                    View
                                </a>
                                <a href="{{ route('admin.orders.edit', $order->id) }}" class="btn btn-sm btn-primary">
                                    Update
                                </a>
                                <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this order?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No orders found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $orders->appends(request()->query())->links() }}
        </div>
    </div>
</div>
@endsection
