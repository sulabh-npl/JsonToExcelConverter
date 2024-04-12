@extends('layouts.user')

@section('title', __('Json to Excel Converter'))

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">{{ __('Json to Excel Converter') }}</div>
            <div class="card-body">
                <form action="{{ route('home.convert') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="json" class="col-md-4 col-form-label text-md-right">{{ __('Json') }}</label>
                        <div class="col-md-6">
                            <input type="file" name="file" id="json" class="form-control @error('json') is-invalid @enderror" required>
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Convert') }}
                            </button>
                            <a href="{{ route('logout') }}" class="btn btn-secondary">
                                {{ __('Logout') }}
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
