@extends('theme::backend.layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card min-vh-100">
                <div class="card-body">
                    <livewire:survey::editor.design slug="nama-survey" />
                </div>
            </div>
        </div>
    </div>
@endsection
