<nav class="sidebar">
    <div class="sidebar-header">
        <a href="{{ url('/dashboard') }}" class="sidebar-brand">
            Modula<span>App</span>
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item nav-category">Main</li>
            <li class="nav-item {{ request()->is('dashboard/*') ? 'active' : '' }}">
                <a href="{{ url('/dashboard') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>
            @can('survey.view')
                <li class="nav-item {{ request()->is('survey') ? 'active' : '' }}">
                    <a href="{{ url('/survey') }}" class="nav-link">
                        <i class="link-icon" data-feather="target"></i>
                        <span class="link-title">Survey</span>
                    </a>
                </li>
            @endcan
            <li class="nav-item nav-category">Admin</li>
            @role('superadmin')
                <li class="nav-item {{ request()->is('crud/*') ? 'active' : '' }}">
                    <a href="{{ url('/crud/build') }}" class="nav-link">
                        <i class="link-icon" data-feather="code"></i>
                        <span class="link-title">Crud</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('module/*') ? 'active' : '' }}">
                    <a href="{{ url('/module') }}" class="nav-link">
                        <i class="link-icon" data-feather="layers"></i>
                        <span class="link-title">Modules</span>
                    </a>
                </li>
            @endrole
            @can('users.view')
                <li class="nav-item {{ request()->is('auth/users') ? 'active' : '' }}">
                    <a href="{{ url('/auth/users') }}" class="nav-link">
                        <i class="link-icon" data-feather="user"></i>
                        <span class="link-title">Users</span>
                    </a>
                </li>
            @endcan
            @can('roles.view')
                <li class="nav-item {{ request()->is('auth/roles') ? 'active' : '' }}">
                    <a href="{{ url('/auth/roles') }}" class="nav-link">
                        <i class="link-icon" data-feather="users"></i>
                        <span class="link-title">Role</span>
                    </a>
                </li>
            @endcan
            @can('permissions.view')
                <li class="nav-item {{ request()->is('auth/permissions') ? 'active' : '' }}">
                    <a href="{{ url('/auth/permissions') }}" class="nav-link">
                        <i class="link-icon" data-feather="shield"></i>
                        <span class="link-title">Permission</span>
                    </a>
                </li>
            @endcan
            <li class="nav-item {{ request()->is('core/menu') ? 'active' : '' }}">
                <a href="{{ url('/core/menu') }}" class="nav-link">
                    <i class="link-icon" data-feather="menu"></i>
                    <span class="link-title">Menus</span>
                </a>
            </li>
            <li class="nav-item nav-category">Blog</li>
            <li class="nav-item {{ request()->is('blog/pages') ? 'active' : '' }}">
                <a href="{{ url('/blog/pages') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Pages</span>
                </a>
            </li>
            <li class="nav-item {{ request()->is('blog/posts') ? 'active' : '' }}">
                <a href="{{ url('/blog/posts') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Posts</span>
                </a>
            </li>
            <li class="nav-item {{ request()->is('blog/categories') ? 'active' : '' }}">
                <a href="{{ url('/blog/categories') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Categories</span>
                </a>
            </li>
            <li class="nav-item {{ request()->is('blog/tags') ? 'active' : '' }}">
                <a href="{{ url('/blog/tags') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Tags</span>
                </a>
            </li>
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
