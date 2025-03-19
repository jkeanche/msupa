@extends('admin.layouts.app')

@section('title', 'Edit User')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Users</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit User</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit User</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="row mb-3">
                        <label for="name" class="col-sm-3 col-form-label">Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                            @error('name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <label for="email" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <label for="phone" class="col-sm-3 col-form-label">Phone</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $user->phone) }}">
                            @error('phone')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <label for="password" class="col-sm-3 col-form-label">Password</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                            <small class="form-text text-muted">Leave blank to keep current password</small>
                            @error('password')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <label for="role" class="col-sm-3 col-form-label">Role</label>
                        <div class="col-sm-9">
                            <select class="form-control @error('role') is-invalid @enderror" id="role" name="role">
                                <option value="user" {{ (old('role', $user->role) == 'user') ? 'selected' : '' }}>User</option>
                                <option value="admin" {{ (old('role', $user->role) == 'admin') ? 'selected' : '' }}>Admin</option>
                            </select>
                            @error('role')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <label for="status" class="col-sm-3 col-form-label">Status</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="status" name="is_active">
                                <option value="1" {{ (old('is_active', $user->is_active) == 1) ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ (old('is_active', $user->is_active) == 0) ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <label for="avatar" class="col-sm-3 col-form-label">Profile Picture</label>
                        <div class="col-sm-9">
                            <input type="file" class="form-control @error('avatar') is-invalid @enderror" id="avatar" name="avatar">
                            <small class="form-text text-muted">Leave blank to keep current image</small>
                            @error('avatar')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-sm-9 offset-sm-3">
                            <button type="submit" class="btn btn-primary">Update User</button>
                            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">User Information</h4>
            </div>
            <div class="card-body">
                <div class="text-center mb-3">
                    @if($user->avatar)
                        <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}" class="rounded-circle img-thumbnail" style="width: 150px; height: 150px; object-fit: cover;">
                    @else
                        <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center mx-auto" style="width: 150px; height: 150px; font-size: 60px; color: white;">
                            {{ substr($user->name, 0, 1) }}
                        </div>
                    @endif
                </div>
                
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <strong>User ID:</strong> {{ $user->id }}
                    </li>
                    <li class="list-group-item">
                        <strong>Joined:</strong> {{ $user->created_at->format('M d, Y') }}
                    </li>
                    <li class="list-group-item">
                        <strong>Last Login:</strong> 
                        {{ $user->last_login_at ? $user->last_login_at->format('M d, Y H:i') : 'Never' }}
                    </li>
                    <li class="list-group-item">
                        <strong>Orders:</strong> {{ $user->orders_count ?? 0 }}
                    </li>
                    <li class="list-group-item">
                        <strong>Total Spent:</strong> Ksh {{ number_format($user->total_spent ?? 0) }}
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
