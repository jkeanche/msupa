@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-2xl font-semibold">Featured Products</h2>
        <a href="{{ route('vendor.featured.create') }}" class="btn btn-primary">
            <i class="fas fa-plus mr-2"></i> Add Featured Product
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Manage Featured Products</h5>
            <div class="input-group" style="width: 300px;">
                <input type="text" class="form-control" placeholder="Search products..." id="searchInput">
                <button class="btn btn-outline-secondary" type="button" id="searchButton">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="py-3" style="width: 60px;">Image</th>
                            <th class="py-3">Product</th>
                            <th class="py-3">Category</th>
                            <th class="py-3">Position</th>
                            <th class="py-3">Start Date</th>
                            <th class="py-3">End Date</th>
                            <th class="py-3">Status</th>
                            <th class="py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($featuredProducts) && count($featuredProducts) > 0)
                            @foreach($featuredProducts as $featured)
                            <tr>
                                <td>
                                    @if($featured->product && $featured->product->image_url)
                                        <img src="{{ asset($featured->product->image_url) }}" alt="{{ $featured->product->name }}" class="rounded" width="50" height="50" style="object-fit: cover;">
                                    @else
                                        <div class="bg-secondary rounded d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                            <i class="fas fa-image text-white"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <div>
                                        <h6 class="mb-0">{{ $featured->product->name ?? 'Unknown Product' }}</h6>
                                        <small class="text-muted">SKU: {{ $featured->product->sku ?? 'N/A' }}</small>
                                    </div>
                                </td>
                                <td>{{ $featured->product->category->name ?? 'N/A' }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        @if(!$loop->first)
                                        <form action="{{ route('vendor.featured.update_position', ['id' => $featured->id, 'direction' => 'up']) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-outline-secondary">
                                                <i class="fas fa-arrow-up"></i>
                                            </button>
                                        </form>
                                        @else
                                        <button type="button" class="btn btn-sm btn-outline-secondary" disabled>
                                            <i class="fas fa-arrow-up"></i>
                                        </button>
                                        @endif
                                        
                                        @if(!$loop->last)
                                        <form action="{{ route('vendor.featured.update_position', ['id' => $featured->id, 'direction' => 'down']) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-outline-secondary">
                                                <i class="fas fa-arrow-down"></i>
                                            </button>
                                        </form>
                                        @else
                                        <button type="button" class="btn btn-sm btn-outline-secondary" disabled>
                                            <i class="fas fa-arrow-down"></i>
                                        </button>
                                        @endif
                                    </div>
                                </td>
                                <td>{{ $featured->start_date ? date('M d, Y', strtotime($featured->start_date)) : 'N/A' }}</td>
                                <td>{{ $featured->end_date ? date('M d, Y', strtotime($featured->end_date)) : 'N/A' }}</td>
                                <td>
                                    @php
                                        $now = now();
                                        $statusClass = 'bg-success';
                                        $statusText = 'Active';
                                        
                                        if (!$featured->is_active) {
                                            $statusClass = 'bg-secondary';
                                            $statusText = 'Inactive';
                                        } elseif ($featured->start_date && $now->lt(\Carbon\Carbon::parse($featured->start_date))) {
                                            $statusClass = 'bg-info text-dark';
                                            $statusText = 'Scheduled';
                                        } elseif ($featured->end_date && $now->gt(\Carbon\Carbon::parse($featured->end_date))) {
                                            $statusClass = 'bg-danger';
                                            $statusText = 'Expired';
                                        }
                                    @endphp
                                    <span class="badge {{ $statusClass }}">{{ $statusText }}</span>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('vendor.featured.edit', $featured->id) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $featured->id }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>

                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="deleteModal{{ $featured->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $featured->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel{{ $featured->id }}">Confirm Delete</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to remove "{{ $featured->product->name ?? 'this product' }}" from featured products?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <form action="{{ route('vendor.featured.destroy', $featured->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Remove</button>
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
                                <td colspan="8" class="text-center py-4">No featured products found</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        @if(isset($featuredProducts) && $featuredProducts instanceof \Illuminate\Pagination\LengthAwarePaginator && $featuredProducts->hasPages())
        <div class="card-footer bg-white">
            {{ $featuredProducts->links() }}
        </div>
        @endif
    </div>

    <!-- Featured Sections -->
    <div class="row mt-5">
        <div class="col-12">
            <h3 class="mb-4">Featured Sections</h3>
        </div>

        <!-- Homepage Banner Section -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Homepage Banner</h5>
                    <a href="{{ route('vendor.featured.create', ['section' => 'homepage_banner']) }}" class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-plus"></i> Add
                    </a>
                </div>
                <div class="card-body">
                    <p class="text-muted">Products featured in the main homepage banner carousel.</p>
                    <div class="d-flex flex-wrap gap-2">
                        @if(isset($homepageBanners) && count($homepageBanners) > 0)
                            @foreach($homepageBanners as $banner)
                                <div class="position-relative">
                                    <div class="card" style="width: 120px;">
                                        <img src="{{ asset($banner->product->image_url ?? 'images/placeholder.jpg') }}" class="card-img-top" alt="{{ $banner->product->name ?? 'Featured Product' }}" style="height: 80px; object-fit: cover;">
                                        <div class="card-body p-2">
                                            <p class="card-text small text-truncate">{{ $banner->product->name ?? 'Product' }}</p>
                                        </div>
                                    </div>
                                    <a href="{{ route('vendor.featured.edit', $banner->id) }}" class="position-absolute top-0 end-0 bg-white rounded-circle p-1 m-1">
                                        <i class="fas fa-edit text-primary"></i>
                                    </a>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center w-100 py-4">
                                <p class="text-muted">No homepage banners configured</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Special Deals Section -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Special Deals</h5>
                    <a href="{{ route('vendor.featured.create', ['section' => 'special_deals']) }}" class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-plus"></i> Add
                    </a>
                </div>
                <div class="card-body">
                    <p class="text-muted">Products featured in the special deals section.</p>
                    <div class="d-flex flex-wrap gap-2">
                        @if(isset($specialDeals) && count($specialDeals) > 0)
                            @foreach($specialDeals as $deal)
                                <div class="position-relative">
                                    <div class="card" style="width: 120px;">
                                        <img src="{{ asset($deal->product->image_url ?? 'images/placeholder.jpg') }}" class="card-img-top" alt="{{ $deal->product->name ?? 'Featured Product' }}" style="height: 80px; object-fit: cover;">
                                        <div class="card-body p-2">
                                            <p class="card-text small text-truncate">{{ $deal->product->name ?? 'Product' }}</p>
                                        </div>
                                    </div>
                                    <a href="{{ route('vendor.featured.edit', $deal->id) }}" class="position-absolute top-0 end-0 bg-white rounded-circle p-1 m-1">
                                        <i class="fas fa-edit text-primary"></i>
                                    </a>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center w-100 py-4">
                                <p class="text-muted">No special deals configured</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Search functionality
        const searchInput = document.getElementById('searchInput');
        const searchButton = document.getElementById('searchButton');
        
        searchButton.addEventListener('click', function() {
            performSearch();
        });
        
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                performSearch();
            }
        });
        
        function performSearch() {
            const searchTerm = searchInput.value.trim();
            if (searchTerm) {
                window.location.href = "{{ route('vendor.featured.index') }}?search=" + encodeURIComponent(searchTerm);
            }
        }
    });
</script>
@endsection
