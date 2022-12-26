@extends('backend.layouts.master')

@section('title')
Post-Category Create
@endsection

@push('admin_style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css">
@endpush

@section('admin_content')
    <div class="row">
        <h1>{{ __('Category Create Form') }}</h1>
        <div class="col-12">
            <div class="d-flex">
                <a href="{{ route('post_category.index') }}" class="btn btn-primary">
                    <i class="fa-solid fa-backward"></i>
                    Back to Categories
                </a>
            </div>
        </div>
        <div class="col-12 mt-4">
            <div class="card p-4">
                <form action="{{ route('post_category.store') }}" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label for="category_name" class="form-label">Category Name</label>
                        <input type="text" name="category_name" class="form-control @error('category_name')
                            is-invalid
                        @enderror" placeholder="Enter Category Name"
                        value="{{ old('category_name') }}">
                        @error('category_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mt-4">
                        <label for="pcategory_image" class="form-label">Category Image</label>
                        <input type="file" name="pcategory_image" class="form-control dropify @error('pcategory_image')
                            is-invalid
                        @enderror" placeholder="Enter Category Title"
                        value="{{ old('pcategory_image') }}">
                        @error('pcategory_image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-check form-switch mt-4">
                        <input class="form-check-input" name="is_active" type="checkbox" role="switch" id="activeStatus" checked>
                        <label class="form-check-label" for="activeStatus">Active or Inactive</label>
                        @error('is_active')
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

@push('admin_script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
<script>
    $('.dropify').dropify();
</script>
@endpush
