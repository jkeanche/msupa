@extends('admin.layouts.app')

@section('title', 'Edit Category')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">Categories</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Category</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Edit Category</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="form-group mb-3">
                <label for="name">Category Name</label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $category->name) }}" required>
                @error('name')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group mb-3">
                <label for="parent_id">Parent Category (optional)</label>
                <select name="parent_id" id="parent_id" class="form-control @error('parent_id') is-invalid @enderror">
                    <option value="">-- None --</option>
                    @foreach($parentCategories as $parentCategory)
                        @if($parentCategory->id != $category->id)
                            <option value="{{ $parentCategory->id }}" {{ old('parent_id', $category->parent_id) == $parentCategory->id ? 'selected' : '' }}>
                                {{ $parentCategory->name }}
                            </option>
                        @endif
                    @endforeach
                </select>
                @error('parent_id')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group mb-3">
                <label for="description">Description (optional)</label>
                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="3">{{ old('description', $category->description) }}</textarea>
                @error('description')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group mb-3">
                <label for="image">Category Image</label>
                <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">
                <small class="text-muted">Leave empty to keep the current image</small>
                @if($category->image)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" style="max-height: 100px;">
                    </div>
                @endif
                @error('image')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group mb-3">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="1" {{ old('status', $category->status) == 1 ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ old('status', $category->status) == 0 ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
            
            <div class="form-group mt-3">
                <button type="submit" class="btn btn-primary">Update Category</button>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
