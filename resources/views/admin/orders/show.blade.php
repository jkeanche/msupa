@extends('layouts.app')

@section('title', 'Order Details')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.orders.index') }}">Orders</a></li>
        <li class="breadcrumb-item active" aria-current="page">Order #{{ $order->id }}</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between">
                <h4 class="card-title">Order #{{ $order->id }}</h4>
                <div>
                    <a href="{{ route('admin.orders.invoice', $order->id) }}" class="btn btn-sm btn-info" target="_blank">
                        <i class="fa fa-file-pdf me-1"></i> Invoice
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h5>Customer Information</h5>
                        <p>
                            <strong>Name:</strong> {{ $order->customer_name }}<br>
                            <strong>Email:</strong> {{ $order->customer_email }}<br>
                            <strong>Phone:</strong> {{ $order->customer_phone }}
                        </p>
                    </div>
                    <div class="col-md-6">
                        <h5>Order Information</h5>
                        <p>
                            <strong>Order Date:</strong> {{ $order->created_at->format('M d, Y H:i') }}<br>
                            <strong>Status:</strong> 
                            <span class="badge bg-{{ $order->status_color }}">{{ ucfirst($order->status) }}</span><br>
                            <strong>Payment Method:</strong> {{ $order->payment_method }}
                        </p>
                    </div>
                </div>

                <h5>Order Items</h5>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th class="text-end">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if($item->product && $item->product->image)
                                            <img src="{{ asset('storage/' . $item->product->image) }}" width="50" class="me-2">
                                        @endif
                                        <div>
                                            {{ $item->product_name }}
                                            @if($item->product)
                                                <br><small class="text-muted">SKU: {{ $item->product->sku ?? 'N/A' }}</small>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>Ksh {{ number_format($item->unit_price) }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td class="text-end">Ksh {{ number_format($item->subtotal) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-end"><strong>Subtotal</strong></td>
                                <td class="text-end">Ksh {{ number_format($order->subtotal) }}</td>
                            </tr>
                            @if($order->discount_amount > 0)
                            <tr>
                                <td colspan="3" class="text-end"><strong>Discount</strong></td>
                                <td class="text-end">- Ksh {{ number_format($order->discount_amount) }}</td>
                            </tr>
                            @endif
                            <tr>
                                <td colspan="3" class="text-end"><strong>Shipping</strong></td>
                                <td class="text-end">Ksh {{ number_format($order->shipping_amount) }}</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-end"><strong>Total</strong></td>
                                <td class="text-end"><strong>Ksh {{ number_format($order->total_amount) }}</strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title">Update Order Status</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.orders.update-status', $order->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    
                    <div class="form-group mb-3">
                        <label for="status">Order Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                            <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="notes">Notes (optional)</label>
                        <textarea name="notes" id="notes" class="form-control" rows="3"></textarea>
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Update Status</button>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title">Shipping Address</h5>
            </div>
            <div class="card-body">
                <address>
                    {{ $order->shipping_address }}<br>
                    {{ $order->shipping_city }}, {{ $order->shipping_state }}<br>
                    {{ $order->shipping_country }} {{ $order->shipping_zipcode }}<br>
                </address>
            </div>
        </div>
        
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Order History</h5>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    @foreach($order->history as $history)
                    <li class="list-group-item">
                        <div class="d-flex justify-content-between">
                            <div>
                                <strong>{{ ucfirst($history->status) }}</strong>
                                @if($history->notes)
                                <p class="mb-0 text-muted">{{ $history->notes }}</p>
                                @endif
                            </div>
                            <small>{{ $history->created_at->format('M d, Y H:i') }}</small>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
