@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-2xl font-semibold">Promotions</h2>
        <a href="{{ route('vendor.promotions.create') }}" class="btn btn-primary">
            <i class="fas fa-plus mr-2"></i> Create New Promotion
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
            <h5 class="mb-0">Filter Promotions</h5>
            <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#filterCollapse" aria-expanded="false" aria-controls="filterCollapse">
                <i class="fas fa-filter me-1"></i> Filters
            </button>
        </div>
        <div class="collapse" id="filterCollapse">
            <div class="card-body">
                <form action="{{ route('vendor.promotions.index') }}" method="GET" class="row g-3">
                    <div class="col-md-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status">
                            <option value="">All Statuses</option>
                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="scheduled" {{ request('status') == 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                            <option value="expired" {{ request('status') == 'expired' ? 'selected' : '' }}>Expired</option>
                            <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="type" class="form-label">Promotion Type</label>
                        <select class="form-select" id="type" name="type">
                            <option value="">All Types</option>
                            <option value="percentage" {{ request('type') == 'percentage' ? 'selected' : '' }}>Percentage Discount</option>
                            <option value="fixed" {{ request('type') == 'fixed' ? 'selected' : '' }}>Fixed Amount</option>
                            <option value="bogo" {{ request('type') == 'bogo' ? 'selected' : '' }}>Buy One Get One</option>
                            <option value="free_shipping" {{ request('type') == 'free_shipping' ? 'selected' : '' }}>Free Shipping</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="date_from" class="form-label">Start Date</label>
                        <input type="date" class="form-control" id="date_from" name="date_from" value="{{ request('date_from') }}">
                    </div>
                    <div class="col-md-3">
                        <label for="date_to" class="form-label">End Date</label>
                        <input type="date" class="form-control" id="date_to" name="date_to" value="{{ request('date_to') }}">
                    </div>
                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-primary">Apply Filters</button>
                        <a href="{{ route('vendor.promotions.index') }}" class="btn btn-outline-secondary">Reset</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <h5 class="mb-0">All Promotions</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="py-3">ID</th>
                            <th class="py-3">Name</th>
                            <th class="py-3">Type</th>
                            <th class="py-3">Value</th>
                            <th class="py-3">Start Date</th>
                            <th class="py-3">End Date</th>
                            <th class="py-3">Status</th>
                            <th class="py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($promotions) && count($promotions) > 0)
                            @foreach($promotions as $promotion)
                            <tr>
                                <td>{{ $promotion->id }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if($promotion->banner_image)
                                            <div class="me-3">
                                                <img src="{{ asset('storage/' . $promotion->banner_image) }}" alt="{{ $promotion->name }}" class="rounded" width="40" height="40" style="object-fit: cover;">
                                            </div>
                                        @endif
                                        <div>
                                            <h6 class="mb-0">{{ $promotion->name }}</h6>
                                            <small class="text-muted">{{ Str::limit($promotion->description, 30) }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @php
                                        $typeLabels = [
                                            'percentage' => 'Percentage',
                                            'fixed' => 'Fixed Amount',
                                            'bogo' => 'Buy One Get One',
                                            'free_shipping' => 'Free Shipping'
                                        ];
                                    @endphp
                                    {{ $typeLabels[$promotion->type] ?? $promotion->type }}
                                </td>
                                <td>
                                    @if($promotion->type == 'percentage')
                                        {{ $promotion->value }}%
                                    @elseif($promotion->type == 'fixed')
                                        Ksh.{{ number_format($promotion->value, 2) }}
                                    @elseif($promotion->type == 'bogo')
                                        Buy {{ $promotion->buy_quantity ?? 1 }}, Get {{ $promotion->get_quantity ?? 1 }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>{{ $promotion->start_date ? date('M d, Y', strtotime($promotion->start_date)) : 'N/A' }}</td>
                                <td>{{ $promotion->end_date ? date('M d, Y', strtotime($promotion->end_date)) : 'N/A' }}</td>
                                <td>
                                    @php
                                        $now = now();
                                        $statusClass = 'bg-secondary';
                                        $statusText = $promotion->status ?? 'Unknown';
                                        
                                        if ($promotion->status == 'active' && $promotion->start_date && $promotion->end_date) {
                                            $startDate = \Carbon\Carbon::parse($promotion->start_date);
                                            $endDate = \Carbon\Carbon::parse($promotion->end_date);
                                            
                                            if ($now->lt($startDate)) {
                                                $statusClass = 'bg-info text-dark';
                                                $statusText = 'Scheduled';
                                            } elseif ($now->gt($endDate)) {
                                                $statusClass = 'bg-danger';
                                                $statusText = 'Expired';
                                            } else {
                                                $statusClass = 'bg-success';
                                                $statusText = 'Active';
                                            }
                                        } elseif ($promotion->status == 'active') {
                                            $statusClass = 'bg-success';
                                        } elseif ($promotion->status == 'draft') {
                                            $statusClass = 'bg-warning text-dark';
                                        } elseif ($promotion->status == 'expired') {
                                            $statusClass = 'bg-danger';
                                        }
                                    @endphp
                                    <span class="badge {{ $statusClass }}">{{ ucfirst($statusText) }}</span>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('vendor.promotions.edit', $promotion->id) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{ route('vendor.promotions.show', $promotion->id) }}" class="btn btn-sm btn-outline-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $promotion->id }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>

                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="deleteModal{{ $promotion->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $promotion->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel{{ $promotion->id }}">Confirm Delete</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete the promotion "{{ $promotion->name }}"?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <form action="{{ route('vendor.promotions.destroy', $promotion->id) }}" method="POST" class="d-inline">
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
                                <td colspan="8" class="text-center py-4">No promotions found</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        @if(isset($promotions) && $promotions->hasPages())
        <div class="card-footer bg-white">
            {{ $promotions->links() }}
        </div>
        @endif
    </div>

    <!-- Promotion Stats Cards -->
    <div class="row mt-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5 class="card-title">Active Promotions</h5>
                    <h2 class="display-4">{{ $activeCount ?? 0 }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <h5 class="card-title">Scheduled</h5>
                    <h2 class="display-4">{{ $scheduledCount ?? 0 }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-dark">
                <div class="card-body">
                    <h5 class="card-title">Drafts</h5>
                    <h2 class="display-4">{{ $draftCount ?? 0 }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-danger text-white">
                <div class="card-body">
                    <h5 class="card-title">Expired</h5>
                    <h2 class="display-4">{{ $expiredCount ?? 0 }}</h2>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize any JavaScript functionality here
    });
</script>
@endsection
