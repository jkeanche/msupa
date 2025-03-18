<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Banner Details</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Title:</strong> {{ $banner->title }}</p>
                    <p><strong>Status:</strong> {{ $banner->status ? 'Active' : 'Inactive' }}</p>
                    <p><strong>Created At:</strong> {{ $banner->created_at->format('d M Y H:i') }}</p>
                </div>
                <div class="col-md-6">
                    @if($banner->image)
                        <img src="{{ asset('storage/' . $banner->image) }}" alt="{{ $banner->title }}" class="img-fluid">
                    @else
                        <p>No image available</p>
                    @endif
                </div>
            </div>
            
            <div class="mt-3">
                <a href="{{ route('admin.banners.edit', $banner->id) }}" class="btn btn-primary">Edit</a>
                <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary">Back</a>
                
                <form action="{{ route('admin.banners.destroy', $banner->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this banner?')">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>