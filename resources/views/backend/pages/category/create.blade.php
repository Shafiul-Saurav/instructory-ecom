@extends('backend.layouts.master')

@section('title')
Category Create
@endsection

@push('admin_style')

@endpush

@section('admin_content')
    <div class="row">
        <h1>{{ __('Category Create Form') }}</h1>
        <div class="col-12">
            <div class="d-flex">
                <a href="{{ route('category.index') }}" class="btn btn-primary">
                    <i class="fa-solid fa-backward"></i>
                    Back to Categories
                </a>
            </div>
        </div>
        <div class="col-12 mt-4">
            <div class="card p-4">
                <form action="{{ route('category.store') }}" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label for="category_title" class="form-label">Category title</label>
                        <input type="text" name="category_title" class="form-control @error('category_title')
                            is-invalid
                        @enderror" placeholder="Enter Category Title"
                        value="{{ old('category_title') }}">
                        @error('category_title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-check form-switch mt-4">
                        <input class="form-check-input" name="is_active" type="checkbox" role="switch" id="activeStatus" checked>
                        <label class="form-check-label" for="activeStatus">Active or Inactive</label>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="button-group mt-4">
                        <input type="submit" class="btn btn-success" value="Store">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
