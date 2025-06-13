@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-2xl font-semibold">Coupons</h2>
        <a href="{{ route('vendor.coupons.create') }}" class="btn btn-primary">
            <i class="fas fa-plus mr-2"></i> Create New Coupon
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
            <h5 class="mb-0">Filter Coupons</h5>
            <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#filterCollapse" aria-expanded="false" aria-controls="filterCollapse">
                <i class="fas fa-filter me-1"></i> Filters
            </button>
        </div>
        <div class="collapse" id="filterCollapse">
            <div class="card-body">
                <form action="{{ route('vendor.coupons.index') }}" method="GET" class="row g-3">
                    <div class="col-md-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status">
                            <option value="">All Statuses</option>
                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            <option value="expired" {{ request('status') == 'expired' ? 'selected' : '' }}>Expired</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="type" class="form-label">Discount Type</label>
                        <select class="form-select" id="type" name="type">
                            <option value="">All Types</option>
                            <option value="percentage" {{ request('type') == 'percentage' ? 'selected' : '' }}>Percentage</option>
                            <option value="fixed" {{ request('type') == 'fixed' ? 'selected' : '' }}>Fixed Amount</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="search" class="form-label">Search</label>
                        <input type="text" class="form-control" id="search" name="search" placeholder="Code or name" value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3">
                        <label for="sort" class="form-label">Sort By</label>
                        <select class="form-select" id="sort" name="sort">
                            <option value="latest" {{ request('sort', 'latest') == 'latest' ? 'selected' : '' }}>Latest</option>
                            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest</option>
                            <option value="most_used" {{ request('sort') == 'most_used' ? 'selected' : '' }}>Most Used</option>
                            <option value="expiry" {{ request('sort') == 'expiry' ? 'selected' : '' }}>Expiry Date</option>
                        </select>
                    </div>
                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-primary">Apply Filters</button>
                        <a href="{{ route('vendor.coupons.index') }}" class="btn btn-outline-secondary">Reset</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <h5 class="mb-0">All Coupons</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="py-3">Code</th>
                            <th class="py-3">Description</th>
                            <th class="py-3">Discount</th>
                            <th class="py-3">Usage / Limit</th>
                            <th class="py-3">Expiry Date</th>
                            <th class="py-3">Status</th>
                            <th class="py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($coupons) && count($coupons) > 0)
                            @foreach($coupons as $coupon)
                            <tr>
                                <td>
                                    <span class="badge bg-dark">{{ $coupon->code }}</span>
                                </td>
                                <td>
                                    <div>
                                        <h6 class="mb-0">{{ $coupon->name }}</h6>
                                        <small class="text-muted">{{ Str::limit($coupon->description, 50) }}</small>
                                    </div>
                                </td>
                                <td>
                                    @if($coupon->discount_type == 'percentage')
                                        <span class="badge bg-info text-dark">{{ $coupon->discount_value }}%</span>
                                    @else
                                        <span class="badge bg-success">Ksh.{{ number_format($coupon->discount_value, 2) }}</span>
                                    @endif
                                </td>
                                <td>
                                    {{ $coupon->usage_count ?? 0 }} / {{ $coupon->usage_limit ? $coupon->usage_limit : '∞' }}
                                </td>
                                <td>
                                    @if($coupon->expires_at)
                                        {{ \Carbon\Carbon::parse($coupon->expires_at)->format('M d, Y') }}
                                        @if(\Carbon\Carbon::parse($coupon->expires_at)->isPast())
                                            <span class="badge bg-danger">Expired</span>
                                        @elseif(\Carbon\Carbon::parse($coupon->expires_at)->diffInDays(now()) < 7)
                                            <span class="badge bg-warning text-dark">Expiring soon</span>
                                        @endif
                                    @else
                                        <span class="text-muted">No expiry</span>
                                    @endif
                                </td>
                                <td>
                                    @php
                                        $statusClass = 'bg-success';
                                        $statusText = 'Active';
                                        
                                        if (!$coupon->is_active) {
                                            $statusClass = 'bg-secondary';
                                            $statusText = 'Inactive';
                                        } elseif ($coupon->expires_at && \Carbon\Carbon::parse($coupon->expires_at)->isPast()) {
                                            $statusClass = 'bg-danger';
                                            $statusText = 'Expired';
                                        } elseif ($coupon->usage_limit && $coupon->usage_count >= $coupon->usage_limit) {
                                            $statusClass = 'bg-warning text-dark';
                                            $statusText = 'Limit reached';
                                        }
                                    @endphp
                                    <span class="badge {{ $statusClass }}">{{ $statusText }}</span>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('vendor.coupons.edit', $coupon->id) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#detailsModal{{ $coupon->id }}">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $coupon->id }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>

                                    <!-- Details Modal -->
                                    <div class="modal fade" id="detailsModal{{ $coupon->id }}" tabindex="-1" aria-labelledby="detailsModalLabel{{ $coupon->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="detailsModalLabel{{ $coupon->id }}">Coupon Details</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <h6 class="fw-bold">Code</h6>
                                                        <p class="mb-0">{{ $coupon->code }}</p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <h6 class="fw-bold">Name</h6>
                                                        <p class="mb-0">{{ $coupon->name }}</p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <h6 class="fw-bold">Description</h6>
                                                        <p class="mb-0">{{ $coupon->description ?? 'No description' }}</p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <h6 class="fw-bold">Discount</h6>
                                                        <p class="mb-0">
                                                            @if($coupon->discount_type == 'percentage')
                                                                {{ $coupon->discount_value }}% off
                                                            @else
                                                                Ksh.{{ number_format($coupon->discount_value, 2) }} off
                                                            @endif
                                                        </p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <h6 class="fw-bold">Minimum Purchase</h6>
                                                        <p class="mb-0">
                                                            @if($coupon->min_purchase_amount)
                                                                Ksh.{{ number_format($coupon->min_purchase_amount, 2) }}
                                                            @else
                                                                No minimum
                                                            @endif
                                                        </p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <h6 class="fw-bold">Usage</h6>
                                                        <p class="mb-0">
                                                            {{ $coupon->usage_count ?? 0 }} used
                                                            @if($coupon->usage_limit)
                                                                out of {{ $coupon->usage_limit }} maximum
                                                            @else
                                                                (unlimited)
                                                            @endif
                                                        </p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <h6 class="fw-bold">Created</h6>
                                                        <p class="mb-0">{{ $coupon->created_at->format('M d, Y H:i') }}</p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <h6 class="fw-bold">Expires</h6>
                                                        <p class="mb-0">
                                                            @if($coupon->expires_at)
                                                                {{ \Carbon\Carbon::parse($coupon->expires_at)->format('M d, Y') }}
                                                                ({{ \Carbon\Carbon::parse($coupon->expires_at)->diffForHumans() }})
                                                            @else
                                                                No expiry date
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="deleteModal{{ $coupon->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $coupon->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel{{ $coupon->id }}">Confirm Delete</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete the coupon <strong>{{ $coupon->code }}</strong>?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <form action="{{ route('vendor.coupons.destroy', $coupon->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7" class="text-center py-4">No coupons found</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        @if(isset($coupons) && $coupons->hasPages())
        <div class="card-footer bg-white">
            {{ $coupons->links() }}
        </div>
        @endif
    </div>

    <!-- Quick Stats -->
    <div class="row mt-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5 class="card-title">Active Coupons</h5>
                    <h2 class="display-4">{{ $coupons->where('is_active', true)->count() }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5 class="card-title">Total Redemptions</h5>
                    <h2 class="display-4">{{ $coupons->sum('usage_count') ?? 0 }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <h5 class="card-title">Avg. Discount</h5>
                    <h2 class="display-4">
                        @php
                            $percentageCoupons = $coupons->where('discount_type', 'percentage');
                            $avgPercentage = $percentageCoupons->count() > 0 ? $percentageCoupons->avg('discount_value') : 0;
                            echo number_format($avgPercentage, 1) . '%';
                        @endphp
                    </h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-dark">
                <div class="card-body">
                    <h5 class="card-title">Expiring Soon</h5>
                    <h2 class="display-4">
                        @php
                            $expiringSoon = $coupons->filter(function($coupon) {
                                return $coupon->expires_at && 
                                       \Carbon\Carbon::parse($coupon->expires_at)->isFuture() && 
                                       \Carbon\Carbon::parse($coupon->expires_at)->diffInDays(now()) <= 7;
                            })->count();
                            echo $expiringSoon;
                        @endphp
                    </h2>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Copy coupon code to clipboard
        const copyButtons = document.querySelectorAll('.copy-code');
        copyButtons.forEach(button => {
            button.addEventListener('click', function() {
                const code = this.getAttribute('data-code');
                navigator.clipboard.writeText(code).then(() => {
                    this.innerHTML = '<i class="fas fa-check"></i>';
                    setTimeout(() => {
                        this.innerHTML = '<i class="fas fa-copy"></i>';
                    }, 2000);
                });
            });
        });
    });
</script>
@endsection
