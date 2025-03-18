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
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Position</th>
                            <th>Status</th>
                            <th>Date Range</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($banners as $banner)
                            <tr>
                                <td>{{ $banner->title }}</td>
                                <td>
                                    <img src="{{ Storage::url($banner->image) }}" alt="{{ $banner->title }}" width="100">
                                </td>
                                <td>{{ str_replace('_', ' ', $banner->position) }}</td>
                                <td>
                                    <span class="badge {{ $banner->is_active ? 'bg-success' : 'bg-danger' }}">
                                        {{ $banner->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>
                                    @if($banner->start_date || $banner->end_date)
                                        {{ $banner->start_date ?? 'N/A' }} - {{ $banner->end_date ?? 'N/A' }}
                                    @else
                                        Always Active
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.banners.edit', $banner) }}" class="btn btn-sm btn-info">Edit</a>
                                    <a href="{{ route('admin.banners.show', $banner) }}" class="btn btn-sm btn-secondary">View</a>
                                    <form action="{{ route('admin.banners.destroy', $banner) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
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
            {{ $banners->links() }}
        </div>
    </div>
</div>
@endsection
