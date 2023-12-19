<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <div class="row justify-content-center">
                <a href="{{ route('dashboard.index') }}">
                    <img alt="image" src="{{ Storage::url('setting/' . $setting->logo) }}" class="mr-1"
                        style="max-width: 40px; max-height: 40px;">
                </a>
                <a href="{{ route('dashboard.index') }}">{{ $setting->name_app }}</a>
            </div>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('dashboard.index') }}">
                <img alt="image" src="{{ Storage::url('setting/' . $setting->logo) }}" class="mr-1"
                    style="max-width: 40px; max-height: 40px;">
            </a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class='{{ Request::is('admin/dashboard') ? 'active' : '' }}'>
                <a class="nav-link" href="{{ route('dashboard.index') }}">
                    <i class="fas fa-fire"></i><span>Dashboard</span>
                </a>
            </li>

            <li class="menu-header">Organization</li>
            <li class='{{ Request::is('admin/user') ? 'active' : '' }}'>
                <a class="nav-link " href="{{ route('user.index') }}">
                    <i class="fas fa-person"></i><span>User</span>
                </a>
            </li>

            <li class="menu-header">Applications</li>
            <li class='{{ Request::is('admin/product') ? 'active' : '' }}'>
                <a class="nav-link " href="{{ route('product.index') }}">
                    <i class="fas fa-cart-shopping"></i><span>Product</span>
                </a>
            </li>
            <li class='{{ Request::is('admin/faq') ? 'active' : '' }}'>
                <a class="nav-link " href="{{ route('faq.index') }}">
                    <i class="fas fa-question"></i><span>Faq</span>
                </a>
            </li>
            <li class='{{ Request::is('admin/tag') ? 'active' : '' }}'>
                <a class="nav-link " href="{{ route('tag.index') }}">
                    <i class="fas fa-tag"></i><span>Tag</span>
                </a>
            </li>
            <li class='{{ Request::is('admin/category') ? 'active' : '' }}'>
                <a class="nav-link " href="{{ route('category.index') }}">
                    <i class="fas fa-layer-group"></i><span>Kategori</span>
                </a>
            </li>
            <li class='{{ Request::is('admin/banner') ? 'active' : '' }}'>
                <a class="nav-link " href="{{ route('banner.index') }}">
                    <i class="fas fa-star"></i><span>Banner</span>
                </a>
            </li>
            <li class='{{ Request::is('admin/setting') ? 'active' : '' }}'>
                <a class="nav-link " href="{{ route('setting.index') }}">
                    <i class="fas fa-gear"></i><span>Settings</span>
                </a>
            </li>
        </ul>
    </aside>
</div>
