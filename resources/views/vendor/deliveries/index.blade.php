@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-2xl font-semibold">Deliveries</h2>
        <a href="{{ route('vendor.deliveries.create') }}" class="btn btn-primary">
            <i class="fas fa-plus mr-2"></i> Create New Delivery
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Filter Deliveries</h5>
            <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#filterCollapse" aria-expanded="false" aria-controls="filterCollapse">
                <i class="fas fa-filter me-1"></i> Filters
            </button>
        </div>
        <div class="collapse" id="filterCollapse">
            <div class="card-body">
                <form action="{{ route('vendor.deliveries.index') }}" method="GET" class="row g-3">
                    <div class="col-md-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status">
                            <option value="">All Statuses</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="in_transit" {{ request('status') == 'in_transit' ? 'selected' : '' }}>In Transit</option>
                            <option value="delivered" {{ request('status') == 'delivered' ? 'selected' : '' }}>Delivered</option>
                            <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>Failed</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="date_from" class="form-label">Date From</label>
                        <input type="date" class="form-control" id="date_from" name="date_from" value="{{ request('date_from') }}">
                    </div>
                    <div class="col-md-3">
                        <label for="date_to" class="form-label">Date To</label>
                        <input type="date" class="form-control" id="date_to" name="date_to" value="{{ request('date_to') }}">
                    </div>
                    <div class="col-md-3">
                        <label for="search" class="form-label">Search</label>
                        <input type="text" class="form-control" id="search" name="search" placeholder="Order ID, Tracking #, Customer" value="{{ request('search') }}">
                    </div>
                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-primary">Apply Filters</button>
                        <a href="{{ route('vendor.deliveries.index') }}" class="btn btn-outline-secondary">Reset</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <h5 class="mb-0">Manage Deliveries</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="py-3">ID</th>
                            <th class="py-3">Order ID</th>
                            <th class="py-3">Tracking Number</th>
                            <th class="py-3">Customer</th>
                            <th class="py-3">Delivery Date</th>
                            <th class="py-3">Status</th>
                            <th class="py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($deliveries) && count($deliveries) > 0)
                            @foreach($deliveries as $delivery)
                            <tr>
                                <td>{{ $delivery->id }}</td>
                                <td>
                                    <a href="{{ route('vendor.orders.show', $delivery->order_id) }}" class="text-decoration-none">
                                        #{{ $delivery->order_id }}
                                    </a>
                                </td>
                                <td>
                                    <span class="badge bg-dark">{{ $delivery->tracking_number ?? 'N/A' }}</span>
                                </td>
                                <td>
                                    {{ $delivery->order->customer->name ?? 'N/A' }}
                                </td>
                                <td>{{ $delivery->delivery_date ? date('M d, Y', strtotime($delivery->delivery_date)) : 'Not scheduled' }}</td>
                                <td>
                                    @php
                                        $statusClass = 'bg-secondary';
                                        switch($delivery->status) {
                                            case 'pending':
                                                $statusClass = 'bg-warning text-dark';
                                                break;
                                            case 'processing':
                                                $statusClass = 'bg-info text-dark';
                                                break;
                                            case 'in_transit':
                                                $statusClass = 'bg-primary';
                                                break;
                                            case 'delivered':
                                                $statusClass = 'bg-success';
                                                break;
                                            case 'failed':
                                                $statusClass = 'bg-danger';
                                                break;
                                        }
                                    @endphp
                                    <span class="badge {{ $statusClass }}">
                                        {{ ucfirst(str_replace('_', ' ', $delivery->status)) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('vendor.deliveries.show', $delivery->id) }}" class="btn btn-sm btn-outline-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('vendor.deliveries.edit', $delivery->id) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#updateStatusModal{{ $delivery->id }}">
                                            <i class="fas fa-truck"></i>
                                        </button>
                                    </div>

                                    <!-- Update Status Modal -->
                                    <div class="modal fade" id="updateStatusModal{{ $delivery->id }}" tabindex="-1" aria-labelledby="updateStatusModalLabel{{ $delivery->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="updateStatusModalLabel{{ $delivery->id }}">Update Delivery Status</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('vendor.deliveries.update_status', $delivery->id) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="status{{ $delivery->id }}" class="form-label">Status</label>
                                                            <select class="form-select" id="status{{ $delivery->id }}" name="status" required>
                                                                <option value="pending" {{ $delivery->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                                <option value="processing" {{ $delivery->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                                                <option value="in_transit" {{ $delivery->status == 'in_transit' ? 'selected' : '' }}>In Transit</option>
                                                                <option value="delivered" {{ $delivery->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                                                <option value="failed" {{ $delivery->status == 'failed' ? 'selected' : '' }}>Failed</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="notes{{ $delivery->id }}" class="form-label">Notes (Optional)</label>
                                                            <textarea class="form-control" id="notes{{ $delivery->id }}" name="notes" rows="3"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-primary">Update Status</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7" class="text-center py-4">No deliveries found</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        @if(isset($deliveries) && $deliveries->hasPages())
        <div class="card-footer bg-white">
            {{ $deliveries->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
