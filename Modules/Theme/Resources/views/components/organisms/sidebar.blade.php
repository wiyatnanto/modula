<nav class="sidebar" x-data x-init="() => {
    if ($('.sidebar .sidebar-body').length) {
        const sidebarBodyScroll = new PerfectScrollbar('.sidebar-body')
    }
    $('.sidebar .sidebar-body').hover(
        function() {
            if ($('body').hasClass('sidebar-folded')) {
                $('body').addClass('open-sidebar-folded')
            }
        },
        function() {
            if ($('body').hasClass('sidebar-folded')) {
                $('body').removeClass('open-sidebar-folded')
            }
        }
    )
}">
    <div class="sidebar-header">
        <a href="{{ url('/dashboard') }}" class="sidebar-brand">
            {{-- Rezam<span>Group</span> --}}
            <img src="{{ url('modules/theme/backend/images/logo.png') }}" style="height: 40px;" />
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body" x-ref="sidebar">
        <ul class="nav">
            @foreach (collect(getMenu('backend'))->sortBy('sort_order') as $menu)
                @if ($menu['type'] === 'separator')
                    <li class="nav-item nav-category">{{ $menu['menu_title'] }}</li>
                @else
                    <li class="nav-item {{ request()->is('dashboard/*') ? 'active' : '' }}">
                        <a href="{{ url($menu['url']) }}" class="nav-link">
                            <x-crud::atoms.icon class="link-icon {{ $menu['icon'] }}" />
                            <span class="link-title">{{ $menu['menu_title'] }}</span>
                        </a>
                    </li>
                @endif
            @endforeach
            {{-- <li class="nav-item nav-category">Main</li>
            <li class="nav-item {{ request()->is('dashboard/*') ? 'active' : '' }}">
                <a href="{{ url('/dashboard') }}" class="nav-link">
                    <x-crud::atoms.icon class="link-icon" icon="analytics" />
                    <span class="link-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item {{ request()->is('survey') ? 'active' : '' }}">
                <a href="{{ url('/survey') }}" class="nav-link">
                    <x-crud::atoms.icon class="link-icon" icon="poll" />
                    <span class="link-title">Survey</span>
                </a>
            </li>
            <li class="nav-item nav-category">Admin</li>
            <li class="nav-item {{ request()->is('crud/*') ? 'active' : '' }}">
                <a href="{{ url('/crud/build') }}" class="nav-link">
                    <x-crud::atoms.icon class="link-icon" icon="dice-d6" />
                    <span class="link-title">Crud</span>
                </a>
            </li>
            <li class="nav-item {{ request()->is('module/*') ? 'active' : '' }}">
                <a href="{{ url('/module') }}" class="nav-link">
                    <x-crud::atoms.icon class="link-icon" icon="layer-group" />
                    <span class="link-title">Modules</span>
                </a>
            </li>
            <li class="nav-item {{ request()->is('auth/users') ? 'active' : '' }}">
                <a href="{{ url('/auth/users') }}" class="nav-link">
                    <x-crud::atoms.icon class="link-icon" icon="user" />
                    <span class="link-title">Users</span>
                </a>
            </li>
            <li class="nav-item {{ request()->is('auth/roles') ? 'active' : '' }}">
                <a href="{{ url('/auth/roles') }}" class="nav-link">
                    <x-crud::atoms.icon class="link-icon" icon="user-tag" />
                    <span class="link-title">Role</span>
                </a>
            </li>
            <li class="nav-item {{ request()->is('auth/permissions') ? 'active' : '' }}">
                <a href="{{ url('/auth/permissions') }}" class="nav-link">
                    <x-crud::atoms.icon class="link-icon" icon="user-shield" />
                    <span class="link-title">Permission</span>
                </a>
            </li>
            <li class="nav-item {{ request()->is('core/menu') ? 'active' : '' }}">
                <a href="{{ url('/core/menu') }}" class="nav-link">
                    <x-crud::atoms.icon class="link-icon" icon="bars" />
                    <span class="link-title">Menus</span>
                </a>
            </li>
            <li class="nav-item nav-category">Store</li>
            <li class="nav-item {{ request()->is('blog/pages') ? 'active' : '' }}">
                <a href="{{ url('/store/products') }}" class="nav-link">
                    <x-crud::atoms.icon class="link-icon" icon="store" />
                    <span class="link-title">Products</span>
                </a>
            </li>
            <li class="nav-item {{ request()->is('blog/posts') ? 'active' : '' }}">
                <a href="{{ url('/store/brands') }}" class="nav-link">
                    <x-crud::atoms.icon class="link-icon" icon="star" />
                    <span class="link-title">Brand</span>
                </a>
            </li>
            <li class="nav-item {{ request()->is('blog/categories') ? 'active' : '' }}">
                <a href="{{ url('/store/categories') }}" class="nav-link">
                    <x-crud::atoms.icon class="link-icon" icon="list" />
                    <span class="link-title">Categories</span>
                </a>
            </li>
            <li class="nav-item {{ request()->is('blog/tags') ? 'active' : '' }}">
                <a href="{{ url('/store/storefronts') }}" class="nav-link">
                    <x-crud::atoms.icon class="link-icon" icon="cabinet-filing" />
                    <span class="link-title">Store Fronts</span>
                </a>
            </li>
            <li class="nav-item nav-category">Blog</li>
            <li class="nav-item {{ request()->is('blog/pages') ? 'active' : '' }}">
                <a href="{{ url('/blog/pages') }}" class="nav-link">
                    <x-crud::atoms.icon class="link-icon" icon="file" />
                    <span class="link-title">Pages</span>
                </a>
            </li>
            <li class="nav-item {{ request()->is('blog/posts') ? 'active' : '' }}">
                <a href="{{ url('/blog/posts') }}" class="nav-link">
                    <x-crud::atoms.icon class="link-icon" icon="paper-plane" />
                    <span class="link-title">Posts</span>
                </a>
            </li>
            <li class="nav-item {{ request()->is('blog/categories') ? 'active' : '' }}">
                <a href="{{ url('/blog/categories') }}" class="nav-link">
                    <x-crud::atoms.icon class="link-icon" icon="list" />
                    <span class="link-title">Categories</span>
                </a>
            </li>
            <li class="nav-item {{ request()->is('blog/tags') ? 'active' : '' }}">
                <a href="{{ url('/blog/tags') }}" class="nav-link">
                    <x-crud::atoms.icon class="link-icon" icon="tags" />
                    <span class="link-title">Tags</span>
                </a>
            </li> --}}
        </ul>
    </div>
</nav>
<nav class="settings-sidebar">
    <div class="sidebar-body">
        <a href="#" class="settings-sidebar-toggler">
            <i data-feather="settings"></i>
        </a>
        <h6 class="text-muted mb-2">Sidebar:</h6>
        <div class="mb-3 pb-3 border-bottom">
            <div class="form-check form-check-inline">
                <input type="radio" class="form-check-input" name="sidebarThemeSettings" id="sidebarLight"
                    value="sidebar-light" checked>
                <label class="form-check-label" for="sidebarLight">
                    Light
                </label>
            </div>
            <div class="form-check form-check-inline">
                <input type="radio" class="form-check-input" name="sidebarThemeSettings" id="sidebarDark"
                    value="sidebar-dark">
                <label class="form-check-label" for="sidebarDark">
                    Dark
                </label>
            </div>
        </div>
        <div class="theme-wrapper">
            <h6 class="text-muted mb-2">Light Theme:</h6>
            <a class="theme-item active" href="../../../demo1/dashboard.html">
                <div class="page-content">
                    <img src="{{ asset('modules/theme/backend/images/screenshots/light.jpg') }}" alt="light theme">
            </a>
            <h6 class="text-muted mb-2">Dark Theme:</h6>
            <a class="theme-item" href="../../../demo2/dashboard.html">
                <img src="{{ asset('modules/theme/backend/images/screenshots/dark.jpg') }}" alt="light theme">
            </a>
        </div>
    </div>
</nav>
