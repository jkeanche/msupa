<!-- resources/views/admin/banners/index.blade.php -->
@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between mb-4">
        <h1>Banner Management</h1>
        <a href="{{ route('admin.banners.create') }}" class="btn btn-primary">Add New Banner</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Banners</h4>
            <a href="{{ route('admin.banners.create') }}" class="btn btn-primary">Add New Banner</a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($banners as $banner)
                            <tr>
                                <td>{{ $banner->id }}</td>
                                <td>{{ $banner->title }}</td>
                                <td>
                                    @if($banner->image)
                                        <img src="{{ asset('storage/' . $banner->image) }}" alt="{{ $banner->title }}" style="max-width: 100px; max-height: 50px;">
                                    @else
                                        No Image
                                    @endif
                                </td>
                                <td>
                                    <span class="badge {{ $banner->status ? 'bg-success' : 'bg-danger' }}">
                                        {{ $banner->status ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>{{ $banner->created_at->format('M d, Y') }}</td>
                                <td>
                                    <a href="{{ route('admin.banners.show', $banner->id) }}" class="btn btn-sm btn-info">
                                        View
                                    </a>
                                    <a href="{{ route('admin.banners.edit', $banner->id) }}" class="btn btn-sm btn-primary">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.banners.destroy', $banner->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this banner?')">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No banners found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $banners->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
