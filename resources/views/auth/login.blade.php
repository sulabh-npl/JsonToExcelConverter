@extends('layouts.user')

@section('title', 'Login')

@section('content')
<div class="row justify-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Login</div>
            <a href="{{ route('login.github') }}" class="btn btn-primary">Login with GitHub</a>
        </div>
    </div>
</div>
@endsection
