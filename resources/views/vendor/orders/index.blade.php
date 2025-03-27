@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-2xl font-semibold">Orders</h2>
        <div>
            <a href="{{ route('vendor.orders.pending') }}" class="btn btn-outline-warning">
                <i class="fas fa-clock mr-2"></i> View Pending Orders
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <div class="row align-items-center">
                <div class="col">
                    <h5 class="mb-0">All Orders</h5>
                </div>
                <div class="col-auto">
                    <form action="{{ route('vendor.orders.index') }}" method="GET" class="form-inline">
                        <div class="input-group">
                            <select name="status" class="form-select">
                                <option value="">All Statuses</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Processing</option>
                                <option value="shipped" {{ request('status') == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                <option value="delivered" {{ request('status') == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                            <input type="text" name="search" class="form-control" placeholder="Search orders..." value="{{ request('search') }}">
                            <button type="submit" class="btn btn-outline-secondary">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th scope="col">Order ID</th>
                            <th scope="col">Customer</th>
                            <th scope="col">Items</th>
                            <th scope="col">Total</th>
                            <th scope="col">Status</th>
                            <th scope="col">Date</th>
                            <th scope="col" width="150">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                            <tr>
                                <td>
                                    <a href="{{ route('vendor.orders.show', $order->id) }}" class="text-decoration-none">
                                        #{{ $order->order_number }}
                                    </a>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 40px; height: 40px;">
                                            {{ substr($order->user->name ?? 'Guest', 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="fw-semibold">{{ $order->user->name ?? 'Guest' }}</div>
                                            <div class="small text-muted">{{ $order->user->email ?? $order->customer_email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $order->items_count }} items</td>
                                <td>Ksh.{{ number_format($order->total, 2) }}</td>
                                <td>
                                    @php
                                        $statusClass = [
                                            'pending' => 'bg-warning',
                                            'processing' => 'bg-info',
                                            'shipped' => 'bg-primary',
                                            'delivered' => 'bg-success',
                                            'cancelled' => 'bg-danger',
                                        ][$order->status] ?? 'bg-secondary';
                                    @endphp
                                    <span class="badge {{ $statusClass }}">{{ ucfirst($order->status) }}</span>
                                </td>
                                <td>{{ $order->created_at->format('M d, Y') }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('vendor.orders.show', $order->id) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fas fa-cog"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            @if($order->status == 'pending')
                                                <li>
                                                    <form action="{{ route('vendor.orders.update-status', $order->id) }}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <input type="hidden" name="status" value="processing">
                                                        <button type="submit" class="dropdown-item">
                                                            <i class="fas fa-box-open me-2"></i> Mark as Processing
                                                        </button>
                                                    </form>
                                                </li>
                                            @elseif($order->status == 'processing')
                                                <li>
                                                    <form action="{{ route('vendor.orders.update-status', $order->id) }}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <input type="hidden" name="status" value="shipped">
                                                        <button type="submit" class="dropdown-item">
                                                            <i class="fas fa-shipping-fast me-2"></i> Mark as Shipped
                                                        </button>
                                                    </form>
                                                </li>
                                            @elseif($order->status == 'shipped')
                                                <li>
                                                    <form action="{{ route('vendor.orders.update-status', $order->id) }}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <input type="hidden" name="status" value="delivered">
                                                        <button type="submit" class="dropdown-item">
                                                            <i class="fas fa-check-circle me-2"></i> Mark as Delivered
                                                        </button>
                                                    </form>
                                                </li>
                                            @endif
                                            
                                            @if(!in_array($order->status, ['delivered', 'cancelled']))
                                                <li>
                                                    <form action="{{ route('vendor.orders.update-status', $order->id) }}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <input type="hidden" name="status" value="cancelled">
                                                        <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Are you sure you want to cancel this order?')">
                                                            <i class="fas fa-times-circle me-2"></i> Cancel Order
                                                        </button>
                                                    </form>
                                                </li>
                                            @endif
                                            
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <a href="{{ route('vendor.orders.invoice', $order->id) }}" class="dropdown-item">
                                                    <i class="fas fa-file-invoice me-2"></i> View Invoice
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="fas fa-shopping-cart fa-3x text-muted mb-3"></i>
                                        <h5>No orders found</h5>
                                        <p class="text-muted">You haven't received any orders yet</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    Showing {{ $orders->firstItem() ?? 0 }} to {{ $orders->lastItem() ?? 0 }} of {{ $orders->total() ?? 0 }} orders
                </div>
                <div>
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
