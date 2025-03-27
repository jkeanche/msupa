
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Edit Banner</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $banner->title) }}" required>
                @error('title')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="image">Banner Image</label>
                <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">
                <small class="text-muted">Leave empty to keep the current image</small>
                @if($banner->image)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $banner->image) }}" alt="{{ $banner->title }}" style="max-width: 200px; max-height: 100px;">
                    </div>
                @endif
                @error('image')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="url">Link URL (optional)</label>
                <input type="url" name="url" id="url" class="form-control @error('url') is-invalid @enderror" value="{{ old('url', $banner->url) }}">
                @error('url')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="1" {{ $banner->status == 1 ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ $banner->status == 0 ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
            
            <div class="form-group mt-3">
                <button type="submit" class="btn btn-primary">Update Banner</button>
                <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
