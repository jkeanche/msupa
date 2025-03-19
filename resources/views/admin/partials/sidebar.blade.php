<div class="sidebar bg-dark text-white">
    <div class="sidebar-header p-3 border-bottom">
        <h3>Msupa Admin</h3>
    </div>
    
    <div class="sidebar-menu p-2">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link text-white {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fa fa-dashboard me-2"></i> Dashboard
                </a>
            </li>
            
            <li class="nav-item">
                <a href="{{ route('admin.banners.index') }}" class="nav-link text-white {{ request()->routeIs('admin.banners.*') ? 'active' : '' }}">
                    <i class="fa fa-image me-2"></i> Banners
                </a>
            </li>
            
            <li class="nav-item">
                <a href="{{ route('admin.users.index') }}" class="nav-link text-white {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <i class="fa fa-users me-2"></i> Users
                </a>
            </li>
            
            <li class="nav-item">
                <a href="{{ route('admin.products.index') }}" class="nav-link text-white {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                    <i class="fa fa-box me-2"></i> Products
                </a>
            </li>
            
            <li class="nav-item">
                <a href="{{ route('admin.categories.index') }}" class="nav-link text-white {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                    <i class="fa fa-list me-2"></i> Categories
                </a>
            </li>
            
            <li class="nav-item">
                <a href="{{ route('admin.orders.index') }}" class="nav-link text-white {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                    <i class="fa fa-shopping-cart me-2"></i> Orders
                </a>
            </li>
            
            <li class="nav-item">
                <a href="{{ route('admin.settings') }}" class="nav-link text-white {{ request()->routeIs('admin.settings') ? 'active' : '' }}">
                    <i class="fa fa-cog me-2"></i> Settings
                </a>
            </li>
        </ul>
    </div>
</div>
