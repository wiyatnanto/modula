<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li class="{{ (request()->is('dashboard')) ? 'mm-active' : '' }}">
                    <a href="{{ url('dashboard') }}" class="waves-effect">
                        <i class="mdi mdi-home-variant-outline"></i>
                        {{-- <span class="badge rounded-pill bg-primary float-end">3</span> --}}
                        <span>Dashboard</span>
                    </a>
                </li>
                
                <li class="{{ (request()->is('student')) ? 'mm-active' : '' }}">
                    <a href="{{ url('student') }}" class=" waves-effect">
                        <i class="mdi mdi-account-box-multiple-outline"></i>
                        <span>Peserta Didik</span>
                    </a>
                </li>

                <li class="{{ (request()->is('student/parent')) ? 'mm-active' : '' }}">
                    <a href="{{ url('student/parent') }}" class=" waves-effect">
                        <i class="mdi mdi-account-child"></i>
                        <span>Orang Tua</span>
                    </a>
                </li>

                <li class="{{ (request()->is('academic/class')) ? 'mm-active' : '' }}">
                    <a href="{{ url('academic/class') }}" class=" waves-effect">
                        <i class="mdi mdi-google-classroom"></i>
                        <span>Rombel</span>
                    </a>
                </li>

                <li class="{{ (request()->is('event')) ? 'mm-active' : '' }}">
                    <a href="{{ url('event') }}" class=" waves-effect">
                        <i class="mdi mdi-calendar-cursor"></i>
                        <span>Kegiatan</span>
                    </a>
                </li>

                <li class="{{ (request()->is('blogxx')) ? 'mm-active' : '' }}">
                    <a href="javascript: void(0);" class="has-arrow waves-effect {{ (request()->is('blogxx')) ? 'mm-active' : '' }}">
                        <i class="mdi mdi-seed-outline"></i>
                        <span>Blog</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ url('auth/users') }}">Artikel</a></li>
                        <li><a href="{{ url('auth/roles') }}">Kategori</a></li>
                        {{-- <li><a href="{{ url('auth/permissions') }}"></a></li> --}}
                    </ul>
                </li>

                <li class="menu-title">Administrasi</li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-clipboard-flow-outline"></i>
                        <span>Keuangan</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ url('accounting/transaction') }}">Transaksi</a></li>
                        <li><a href="{{ url('accounting/bill') }}">Tagihan</a></li>
                        <li><a href="{{ url('accounting/savings') }}">Tabungan</a></li>
                        <li><a href="{{ url('accounting/receipt') }}">Kuwitansi</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-office-building"></i>
                        <span>Sekolah</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="email-inbox.html">Dokumen</a></li>
                    </ul>
                </li>

                <li class="menu-title">Alat & Media</li>

                <li class="{{ (request()->is('meet')) ? 'mm-active' : '' }}">
                    <a href="{{ url('meet') }}" class=" waves-effect">
                        <i class="mdi mdi-message-video"></i>
                        <span>Daring</span>
                    </a>
                </li>

                <li class="menu-title">Admin</li>

                <li class="{{ (request()->is('auth/users')) ? 'mm-active' : '' }}">
                    <a href="javascript: void(0);" class="has-arrow waves-effect {{ (request()->is('auth/users')) ? 'mm-active' : '' }}">
                        <i class="mdi mdi-shield-account"></i>
                        <span>Akun</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ url('auth/users') }}">Pengguna</a></li>
                        <li><a href="{{ url('auth/roles') }}">Peran</a></li>
                        <li><a href="{{ url('auth/permissions') }}">Hak Akses</a></li>
                    </ul>
                </li>

                <li class="{{ (request()->is('setting')) ? 'mm-active' : '' }}">
                    <a href="{{ url('setting') }}" class="waves-effect">
                        <i class="mdi mdi-cog-outline"></i>
                        {{-- <span class="badge rounded-pill bg-primary float-end">3</span> --}}
                        <span>Pengaturan</span>
                    </a>
                </li>

                <li class="{{ (request()->is('crud/builder')) ? 'mm-active' : '' }}">
                    <a href="{{ url('crud/builder') }}" class="waves-effect">
                        <i class="mdi mdi-code-tags"></i>
                        {{-- <span class="badge rounded-pill bg-primary float-end">3</span> --}}
                        <span>Developer</span>
                    </a>
                </li>


                {{-- <li class="menu-title">Layouts</li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-gradient"></i>
                        <span>Vertical</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="layouts-light-sidebar.html">Light Sidebar</a></li>
                        <li><a href="layouts-compact-sidebar.html">Compact Sidebar</a></li>
                        <li><a href="layouts-icon-sidebar.html">Icon Sidebar</a></li>
                        <li><a href="layouts-boxed.html">Boxed Layout</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-page-layout-header"></i>
                        <span>Horizontal</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="layouts-horizontal.html">Default</a></li>
                        <li><a href="layouts-hori-topbar-dark.html">Topbar Dark</a></li>
                        <li><a href="layouts-hori-boxed-width.html">Boxed width</a></li>
                    </ul>
                </li>

                <li class="menu-title">Pages</li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-account-circle-outline"></i>
                        <span>Authentication</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="auth-login.html">Login</a></li>
                        <li><a href="auth-register.html">Register</a></li>
                        <li><a href="auth-recoverpw.html">Recover Password</a></li>
                        <li><a href="auth-lock-screen.html">Lock Screen</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-format-page-break"></i>
                        <span>Utility</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="pages-starter.html">Starter Page</a></li>
                        <li><a href="pages-maintenance.html">Maintenance</a></li>
                        <li><a href="pages-comingsoon.html">Coming Soon</a></li>
                        <li><a href="pages-timeline.html">Timeline</a></li>
                        <li><a href="pages-faqs.html">FAQs</a></li>
                        <li><a href="pages-pricing.html">Pricing</a></li>
                        <li><a href="pages-404.html">Error 404</a></li>
                        <li><a href="pages-500.html">Error 500</a></li>
                    </ul>
                </li>

                <li class="menu-title">Components</li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-briefcase-variant-outline"></i>
                        <span>UI Elements</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="ui-alerts.html">Alerts</a></li>
                        <li><a href="ui-badge.html">Badge</a></li>
                        <li><a href="ui-breadcrumb.html">Breadcrumb</a></li>
                        <li><a href="ui-buttons.html">Buttons</a></li>
                        <li><a href="ui-cards.html">Cards</a></li>
                        <li><a href="ui-carousel.html">Carousel</a></li>
                        <li><a href="ui-dropdowns.html">Dropdowns</a></li>
                        <li><a href="ui-grid.html">Grid</a></li>
                        <li><a href="ui-images.html">Images</a></li>
                        <li><a href="ui-lightbox.html">Lightbox</a></li>
                        <li><a href="ui-modals.html">Modals</a></li>
                        <li><a href="ui-offcanvas.html">Offcanvas</a></li>
                        <li><a href="ui-rangeslider.html">Range Slider</a></li>
                        <li><a href="ui-session-timeout.html">Session Timeout</a></li>
                        <li><a href="ui-pagination.html">Pagination</a></li>
                        <li><a href="ui-progressbars.html">Progress Bars</a></li>
                        <li><a href="ui-placeholders.html">Placeholders</a></li>
                        <li><a href="ui-sweet-alert.html">Sweetalert 2</a></li>
                        <li><a href="ui-tabs-accordions.html">Tabs & Accordions</a></li>
                        <li><a href="ui-typography.html">Typography</a></li>
                        <li><a href="ui-toasts.html">Toasts</a></li>
                        <li><a href="ui-video.html">Video</a></li>
                        <li><a href="ui-popover-tooltips.html">Popovers &amp; Tooltips</a></li>
                        <li><a href="ui-rating.html">Rating</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="ri-eraser-fill"></i>
                        <span class="badge rounded-pill bg-danger float-end">8</span>
                        <span>Forms</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="form-elements.html">Form Elements</a></li>
                        <li><a href="form-validation.html">Form Validation</a></li>
                        <li><a href="form-advanced.html">Form Advanced Plugins</a></li>
                        <li><a href="form-editors.html">Form Editors</a></li>
                        <li><a href="form-uploads.html">Form File Upload</a></li>
                        <li><a href="form-xeditable.html">Form X-editable</a></li>
                        <li><a href="form-wizard.html">Form Wizard</a></li>
                        <li><a href="form-mask.html">Form Mask</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-table-2"></i>
                        <span>Tables</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="tables-basic.html">Basic Tables</a></li>
                        <li><a href="tables-datatable.html">Data Tables</a></li>
                        <li><a href="tables-responsive.html">Responsive Table</a></li>
                        <li><a href="tables-editable.html">Editable Table</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-bar-chart-line"></i>
                        <span>Charts</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="charts-apex.html">Apex Charts</a></li>
                        <li><a href="charts-chartjs.html">Chartjs Charts</a></li>
                        <li><a href="charts-flot.html">Flot Charts</a></li>
                        <li><a href="charts-knob.html">Jquery Knob Charts</a></li>
                        <li><a href="charts-sparkline.html">Sparkline Charts</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-brush-line"></i>
                        <span>Icons</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="icons-remix.html">Remix Icons</a></li>
                        <li><a href="icons-materialdesign.html">Material Design</a></li>
                        <li><a href="icons-dripicons.html">Dripicons</a></li>
                        <li><a href="icons-fontawesome.html">Font Awesome </a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-map-pin-line"></i>
                        <span>Maps</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="maps-google.html">Google Maps</a></li>
                        <li><a href="maps-vector.html">Vector Maps</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-share-line"></i>
                        <span>Multi Level</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="javascript: void(0);">Level 1.1</a></li>
                        <li><a href="javascript: void(0);" class="has-arrow">Level 1.2</a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="javascript: void(0);">Level 2.1</a></li>
                                <li><a href="javascript: void(0);">Level 2.2</a></li>
                            </ul>
                        </li>
                    </ul>
                </li> --}}
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->