<div class="pd-t-20 pd-b-10 pd-x-20">
    <ul class="sidebar-nav" wire:ignore>
        <li class="nav-item mg-b-15">
            <a href="{{ url('/') }}" class="nav-link" target="_blank">
                <i class="fal fa-store tx-16-f"></i>
                <span>Toko</span>
            </a>
        </li>
        <li class="nav-label mg-b-15">Produk</li>
        <li class="nav-item">
            <a href="{{ url('store/product') }}"
                class="nav-link {{ (request()->is('store/product')) ? 'active' : '' }}">
                <i class="fal fa-box-alt tx-20-f"></i>
                <span>Produk</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ url('store/category') }}"
                class="nav-link {{ (request()->is('store/category')) ? 'active' : '' }}">
                <i class="fal fa-stream"></i>
                <span>Kategori</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ url('store/storefront') }}"
                class="nav-link {{ (request()->is('store/storefront') || request()->is('store/storefront/*') ? 'active' : '') }}">
                <i class="fal fa-cabinet-filing"></i>
                <span>Etalase</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ url('store/brand') }}" class="nav-link {{ (request()->is('store/brand')) ? 'active' : '' }}">
                <i class="fal fa-badge-check"></i>
                <span>Merek</span>
            </a>
        </li>
    </ul>
    <ul class="sidebar-nav mg-b-15 mt-2" wire:ignore>
        <li class="nav-label mg-b-15">Penjualan</li>
        <li class="nav-item">
            <a href="{{ url('store/sale') }}" class="nav-link {{ (request()->is('store/sale')) ? 'active' : '' }}">
                <i class="fal fa-bags-shopping"></i>
                <span>Penjualan</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ url('store/ship') }}" class="nav-link {{ (request()->is('store/ship')) ? 'active' : '' }}">
                <i class="fal fa-dolly"></i>
                <span>Pengiriman</span>
            </a>
        </li>
    </ul>
    <ul class="sidebar-nav mg-b-15 mt-2" wire:ignore>
        <li class="nav-label mg-b-15">Situs</li>
        <li class="nav-item">
            <a href="{{ url('core/setting') }}" class="nav-link {{ (request()->is('core/setting')) ? 'active' : '' }}">
                <i class="fal fa-cog"></i>
                <span>Setting</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ url('core/user') }}" class="nav-link {{ (request()->is('core/user')) ? 'active' : '' }}">
                <i class="fal fa-user"></i>
                <span>Pengguna</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ url('site/page') }}" class="nav-link {{ (request()->is('site/page')) ? 'active' : '' }}">
                <i class="fal fa-paper-plane"></i>
                <span>Halaman</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ url('site/menu') }}" class="nav-link {{ (request()->is('site/menu')) ? 'active' : '' }}">
                <i class="fal fa-compass"></i>
                <span>Menu</span>
            </a>
        </li>
    </ul>
</div>