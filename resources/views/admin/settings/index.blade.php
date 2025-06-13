@extends('layouts.app')

@section('title', 'System Settings')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Settings</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="card-title">System Settings</h4>
    </div>
    <div class="card-body">
        <ul class="nav nav-tabs" id="settingsTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="general-tab" data-bs-toggle="tab" data-bs-target="#general" type="button" role="tab" aria-controls="general" aria-selected="true">General</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="appearance-tab" data-bs-toggle="tab" data-bs-target="#appearance" type="button" role="tab" aria-controls="appearance" aria-selected="false">Appearance</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="emails-tab" data-bs-toggle="tab" data-bs-target="#emails" type="button" role="tab" aria-controls="emails" aria-selected="false">Emails</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="payments-tab" data-bs-toggle="tab" data-bs-target="#payments" type="button" role="tab" aria-controls="payments" aria-selected="false">Payments</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="shipping-tab" data-bs-toggle="tab" data-bs-target="#shipping" type="button" role="tab" aria-controls="shipping" aria-selected="false">Shipping</button>
            </li>
        </ul>
        
        <div class="tab-content p-3 border border-top-0 rounded-bottom" id="settingsTabsContent">
            <!-- General Settings -->
            <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
                <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="section" value="general">
                    
                    <div class="row mb-3">
                        <label for="site_name" class="col-sm-3 col-form-label">Site Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="site_name" name="site_name" value="{{ $settings['site_name'] ?? '' }}">
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <label for="site_description" class="col-sm-3 col-form-label">Site Description</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" id="site_description" name="site_description" rows="2">{{ $settings['site_description'] ?? '' }}</textarea>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <label for="admin_email" class="col-sm-3 col-form-label">Admin Email</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" id="admin_email" name="admin_email" value="{{ $settings['admin_email'] ?? '' }}">
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <label for="phone_number" class="col-sm-3 col-form-label">Phone Number</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ $settings['phone_number'] ?? '' }}">
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <label for="address" class="col-sm-3 col-form-label">Address</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" id="address" name="address" rows="3">{{ $settings['address'] ?? '' }}</textarea>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-sm-9 offset-sm-3">
                            <button type="submit" class="btn btn-primary">Save Settings</button>
                        </div>
                    </div>
                </form>
            </div>
            
            <!-- Appearance Settings -->
            <div class="tab-pane fade" id="appearance" role="tabpanel" aria-labelledby="appearance-tab">
                <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="section" value="appearance">
                    
                    <div class="row mb-3">
                        <label for="logo" class="col-sm-3 col-form-label">Site Logo</label>
                        <div class="col-sm-9">
                            <input type="file" class="form-control" id="logo" name="logo">
                            @if(!empty($settings['logo']))
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $settings['logo']) }}" alt="Site Logo" height="50">
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <label for="favicon" class="col-sm-3 col-form-label">Favicon</label>
                        <div class="col-sm-9">
                            <input type="file" class="form-control" id="favicon" name="favicon">
                            @if(!empty($settings['favicon']))
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $settings['favicon']) }}" alt="Favicon" height="32">
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <label for="primary_color" class="col-sm-3 col-form-label">Primary Color</label>
                        <div class="col-sm-9">
                            <input type="color" class="form-control form-control-color" id="primary_color" name="primary_color" value="{{ $settings['primary_color'] ?? '#0d6efd' }}">
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <label for="footer_text" class="col-sm-3 col-form-label">Footer Text</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" id="footer_text" name="footer_text" rows="2">{{ $settings['footer_text'] ?? '' }}</textarea>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-sm-9 offset-sm-3">
                            <button type="submit" class="btn btn-primary">Save Settings</button>
                        </div>
                    </div>
                </form>
            </div>
            
            <!-- More tabs would be implemented similarly -->
            <div class="tab-pane fade" id="emails" role="tabpanel" aria-labelledby="emails-tab">
                <p class="text-muted">Email configuration settings would go here...</p>
            </div>
            
            <div class="tab-pane fade" id="payments" role="tabpanel" aria-labelledby="payments-tab">
                <p class="text-muted">Payment gateway settings would go here...</p>
            </div>
            
            <div class="tab-pane fade" id="shipping" role="tabpanel" aria-labelledby="shipping-tab">
                <p class="text-muted">Shipping configuration settings would go here...</p>
            </div>
        </div>
    </div>
</div>
@endsection
