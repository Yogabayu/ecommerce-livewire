<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="#">e-Artha</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="#">eA</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class='{{ Request::is('admin/dashboard') ? 'active' : '' }}'>
                <a class="nav-link" href="{{ route('dashboard.index') }}">
                    <i class="fas fa-fire"></i><span>Dashboard</span>
                </a>
            </li>
            <li class="menu-header">Organization</li>
            <li class='{{ Request::is('user') ? 'active' : '' }}'>
                <a class="nav-link " href="{{ route('user.index') }}">
                    <i class="fas fa-person"></i><span>User</span>
                </a>
            </li>
        </ul>
    </aside>
</div>
