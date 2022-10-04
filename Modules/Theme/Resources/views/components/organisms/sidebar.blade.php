<nav class="sidebar" x-data x-init="() => {
    if ($('.sidebar .sidebar-body').length) {
        const sidebarBodyScroll = new PerfectScrollbar('.sidebar-body', {
            scrollYMarginOffset: 100
        })
    }
    $('.sidebar .sidebar-body').hover(
        function() {
            $('body').css('overflow', 'hidden')
            if ($('body').hasClass('sidebar-folded')) {
                $('body').addClass('open-sidebar-folded')
            }
        },
        function() {
            $('body').css('overflow', 'auto')
            if ($('body').hasClass('sidebar-folded')) {
                $('body').removeClass('open-sidebar-folded')
            }
        }
    )
    $('.sidebar-toggler').on('click', function(e) {
        $('.sidebar-header .sidebar-toggler').toggleClass(
            'active not-active'
        )
        if (window.matchMedia('(min-width: 992px)').matches) {
            e.preventDefault()
            $('body').toggleClass('sidebar-folded')
        } else if (window.matchMedia('(max-width: 991px)').matches) {
            e.preventDefault()
            $('body').toggleClass('sidebar-open')
        }
    })
}">
    <div class="sidebar-header">
        <a href="{{ url('/dashboard') }}" class="sidebar-brand">
            <img src="{{ url('modules/theme/backend/images/logo.png') }}" style="height: 45px;" />
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
                    <li class="nav-item {{ request()->is(ltrim($menu['url'], '/')) ? 'active' : '' }}">
                        <a href="{{ url($menu['url']) }}" class="nav-link">
                            <x-crud::atoms.icon class="link-icon {{ $menu['icon'] }}" />
                            <span class="link-title">{{ $menu['menu_title'] }}</span>
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
</nav>
<nav class="settings-sidebar">
    <div class="sidebar-body">
        <a href="#" class="settings-sidebar-toggler text-muted">
            <x-crud::atoms.icon icon="tools" />
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
