<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Banner Details</h4>
            <div>
                <a href="{{ route('admin.banners.edit', $banner->id) }}" class="btn btn-primary">Edit</a>
                <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary">Back to List</a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table">
                        <tr>
                            <th>ID</th>
                            <td>{{ $banner->id }}</td>
                        </tr>
                        <tr>
                            <th>Title</th>
                            <td>{{ $banner->title }}</td>
                        </tr>
                        <tr>
                            <th>URL</th>
                            <td>
                                @if($banner->url)
                                    <a href="{{ $banner->url }}" target="_blank">{{ $banner->url }}</a>
                                @else
                                    Not Set
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <span class="badge {{ $banner->status ? 'bg-success' : 'bg-danger' }}">
                                    {{ $banner->status ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Created</th>
                            <td>{{ $banner->created_at->format('M d, Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th>Last Updated</th>
                            <td>{{ $banner->updated_at->format('M d, Y H:i') }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <h5>Banner Image</h5>
                    @if($banner->image)
                        <img src="{{ asset('storage/' . $banner->image) }}" alt="{{ $banner->title }}" class="img-fluid">
                    @else
                        <p>No image available</p>
                    @endif
                </div>
            </div>
            
            <div class="mt-4">
                <form action="{{ route('admin.banners.destroy', $banner->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this banner?')">
                        Delete Banner
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>