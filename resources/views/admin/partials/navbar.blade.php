<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
    <div class="container-fluid">
        <button class="btn btn-sm" id="sidebar-toggle">
            <i class="fa fa-bars"></i>
        </button>
        
        <div class="ms-auto d-flex">
            <div class="dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="fa fa-bell me-1"></i>
                    <span class="badge bg-danger">3</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a href="#" class="dropdown-item">New Order #123</a>
                    <a href="#" class="dropdown-item">New User Registration</a>
                    <a href="#" class="dropdown-item">System Update Available</a>
                </div>
            </div>
            
            <div class="dropdown ms-3">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <img src="{{ auth()->user()->avatar ?? asset('images/default-avatar.png') }}" alt="Profile" class="rounded-circle" width="30" height="30">
                    <span class="ms-1">{{ auth()->user()->name }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a href="#" class="dropdown-item">My Profile</a>
                    <a href="{{ route('admin.settings.index') }}" class="dropdown-item">Settings</a>
                    <div class="dropdown-divider"></div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>
