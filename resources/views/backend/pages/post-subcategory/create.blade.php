@extends('backend.layouts.master')

@section('title')
Post-Subategory Create
@endsection

@push('admin_style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css">
@endpush

@section('admin_content')
    <div class="row">
        <h1>{{ __('Subategory Create Form') }}</h1>
        <div class="col-12">
            <div class="d-flex">
                <a href="{{ route('post_subcategory.index') }}" class="btn btn-primary">
                    <i class="fa-solid fa-backward"></i>
                    Back to Subategories
                </a>
            </div>
        </div>
        <div class="col-12 mt-4">
            <div class="card p-4">
                <form action="{{ route('post_subcategory.store') }}" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group mb-3">
                        <label for="subcategory_name" class="form-label">Category Name</label>
                        <select name="pcategory_id" id="" class="form-select">
                            <option selected>Choose A Category</option>
                            @foreach ($postCategories as $postCategory)
                                <option value="{{ $postCategory->id }}">{{ $postCategory->category_name }}</option>
                            @endforeach
                        </select>
                        @error('subcategory_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="subcategory_name" class="form-label">Category Name</label>
                        <input type="text" name="subcategory_name" class="form-control @error('subcategory_name')
                            is-invalid
                        @enderror" placeholder="Enter Category Name"
                        value="{{ old('subcategory_name') }}">
                        @error('subcategory_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mt-4">
                        <label for="subcategory_image" class="form-label">Category Image</label>
                        <input type="file" name="subcategory_image" class="form-control dropify @error('subcategory_image')
                            is-invalid
                        @enderror" placeholder="Enter Category Title"
                        value="{{ old('subcategory_image') }}">
                        @error('subcategory_image')
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
