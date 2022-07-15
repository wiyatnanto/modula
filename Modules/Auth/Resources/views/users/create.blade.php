@extends('theme::backend.layouts.master')

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create User</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Create user</div>
                <div class="card-body">
                    {!! Form::open(['route' => 'users.store', 'method' => 'POST', 'id' => '#createForm']) !!}
                    <div class="mb-3">
                        <strong>Name:</strong>
                        <input placeholder="Name" class="form-control @error('name') is-invalid @enderror" name="name"
                            type="text">
                        @error('name')
                            <label id="name-error" class="error invalid-feedback" for="name">{{ $message }}</label>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <strong>Email:</strong>
                        <input placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email"
                            type="text">
                        @error('email')
                            <label id="email-error" class="error invalid-feedback" for="name">{{ $message }}</label>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <strong>Password:</strong>
                        <input placeholder="Password" class="form-control @error('password') is-invalid @enderror"
                            name="password" type="password" value="">
                        @error('password')
                            <label id="password-error" class="error invalid-feedback" for="password">{{ $message }}</label>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <strong>Confirm Password:</strong>
                        <input placeholder="Confirm Password"
                            class="form-control @error('password_confirmation') is-invalid @enderror"
                            name="password_confirmation" type="password" value="">
                        @error('password_confirmation')
                            <label id="password_confirmation-error" class="error invalid-feedback"
                                for="password_confirmation">{{ $message }}</label>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <strong>Role:</strong>
                        <select class="js-example-basic-multiple form-select @error('roles') is-invalid @enderror"
                            name="roles[]" multiple="multiple">
                            @if (!empety($roles))
                                @foreach ($roles as $val)
                                    <option value="{{ $val }}">{{ $val }}</option>
                                @endforeach
                            @endif
                        </select>
                        <select class="js-example-basic-multiple form-select @error('roles') is-invalid @enderror"
                        wire:model="role[]" multiple="multiple">
                        @if (!empty($roles))
                            @foreach ($roles as $val)
                                <option value="{{ $val }}">{{ $val }}</option>
                            @endforeach
                        @endif
                    </select>
                        @error('roles')
                            <label id="password_confirmation-error" class="error invalid-feedback"
                                for="roles">{{ $message }}</label>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-xs btn-primary">Submit</button>
                    <a class="btn btn-xs btn-secondary" href="{{ route('users.index') }}">Cancel</a>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(function() {
            if ($(".js-example-basic-multiple").length) {
                $(".js-example-basic-multiple").select2();
            }
        });
    </script>
@endpush
