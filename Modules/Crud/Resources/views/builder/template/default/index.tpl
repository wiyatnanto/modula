@extends('layouts.app')

@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('dashboard')}}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">{!! $title !!}</li>
    </ol>
</nav>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline">
                    <h6 class="card-title mb-4">{{ $title }}</h6>
                    <div class="dropdown mb-2">
                        <button class="btn p-0" type="button"  data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item d-flex align-items-center" href="{{ url('builder/config/'.$module)}}"><i data-feather="eye" class="icon-sm me-2"></i>
                                <span class="">@lang('core.t_configmodule')</span>
                            </a>
                        </div>
                    </div>
                </div>
                {!! $table !!}
            </div>
        </div>
    </div>
</div>
@endsection