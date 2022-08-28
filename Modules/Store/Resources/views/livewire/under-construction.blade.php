<div>
    <div class="modula-wrapper">
        <div class="modula-sidebar @if($minimize) minimize @endif">
            <div class="modula-sidebar-header">
                <a wire:click="toggleSidebar" class="modula-sidebar-toggle">
                    @if($minimize) <i class="fas fa-chevron-right"></i> @else <i class="fas fa-chevron-left"></i> @endif
                    <span>Sembunyikan Menu</span>
                </a>
            </div>
            <div class="modula-sidebar-body">
                @livewire('store::sidebar')
            </div>
        </div>
        <div class="modula-content @if($minimize) minimize @endif">
            <div class="modula-content-header">
                <i data-feather="search"></i>
                <div class="search-form">
                    <input type="search" class="form-control" placeholder="Search for files and folders">
                </div>
                <nav class="nav d-none d-sm-flex mg-l-auto">
                    <a href="" class="nav-link"><i data-feather="list"></i></a>
                    <a href="" class="nav-link"><i data-feather="alert-circle"></i></a>
                    <a href="" class="nav-link"><i data-feather="settings"></i></a>
                </nav>
            </div>
            <div class="modula-content-body no-header">
                    <div class="ht-100p d-flex flex-column align-items-center justify-content-center">
                        <div class="wd-70p wd-sm-250 wd-lg-300 mg-b-15"><img src="{{ asset('modules/core/images/underconstruction.png') }}" class="img-fluid" alt=""></div>
                        <h1 class="tx-color-01 tx-18 tx-sm-20 tx-lg-25 mg-xl-b-5">Under Construction</h1> 
                        <p class="tx-color-03 mg-b-30">Modul dalam pengembangan.</p>
                        <div class="mg-b-40"><a href="{{ url('store/product') }}" class="btn btn-sm btn-white bd-2 pd-x-30">Kembali ke Product</a></div>
                    </div>
            </div>
        </div>
    </div>
</div>
</div>
@push('styles')
<link rel="stylesheet" href="{{ asset('modules/store/css/store-bundle.css') }}">
<link rel="stylesheet" href="{{ asset('modules/store/css/store.css') }}">
@endpush
@push('scripts')
<script src="{{ asset('modules/store/js/store-bundle.js') }}"></script>
<script src="{{ asset('modules/store/js/store.js') }}"></script>
@endpush