@extends('theme::frontend.default.master')

@section('content')
    <h1>Modula</h1>
    <p>
        This view is loaded from module: {!! config('blog.name') !!}
    </p>
    <a href="{{ url('auth/login') }}">Login</a>
@endsection
