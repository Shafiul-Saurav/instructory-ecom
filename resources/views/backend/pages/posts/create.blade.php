@extends('backend.layouts.master')

@section('title')
Post Create
@endsection

@push('admin_style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('admin_content')
    <div class="row">
        <h1>{{ __('Post Create Form') }}</h1>
        <div class="col-12">
            <div class="d-flex">
                <a href="{{ route('post.index') }}" class="btn btn-primary">
                    <i class="fa-solid fa-backward"></i>
                    Back to Posts
                </a>
            </div>
        </div>
        <div class="col-12 mt-4">
            <div class="card p-4">
                <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="category_name" class="form-label">Category Name</label>
                                <select name="pcategory_id" id="pcategory_id" class="form-select
                                @error('pcategory_id')
                                    is-invalid
                                @enderror">
                                    <option selected>Choose A Category</option>
                                    @foreach ($postCategories as $postCategory)
                                        <option value="{{ $postCategory->id }}">{{ $postCategory->category_name }}</option>
                                    @endforeach
                                </select>
                                @error('category_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="subcategory_name" class="form-label">Subcategory Name</label>
                                <select name="subcategory_id" id="subcategory_id" class="form-select">
                                    <option value="">Choose A Subcategory</option>
                                    @foreach ($postSubcategories as $postSubcategory)
                                        <option value="{{ $postSubcategory->id }}">{{ $postSubcategory->subcategory_name }}</option>
                                    @endforeach
                                </select>
                                @error('subcategory_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label for="post_name" class="form-label">Post Title</label>
                                <input type="text" name="post_name" class="form-control @error('post_name')
                                    is-invalid
                                @enderror" placeholder="Enter Category Name"
                                value="{{ old('post_name') }}">
                                @error('post_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label for="post_description" class="form-label">Post Description</label>
                                <textarea name="post_description" id="" cols="30" rows="5" class="form-control"></textarea>
                                @error('post_description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mt-4">
                                <label for="post_image" class="form-label">Category Image</label>
                                <input type="file" name="post_image" class="form-control dropify @error('post_image')
                                    is-invalid
                                @enderror" placeholder="Enter Category Title"
                                value="{{ old('post_image') }}">
                                @error('post_image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-check form-switch mt-4">
                                <input class="form-check-input" name="is_active" type="checkbox" role="switch" id="activeStatus" checked>
                                <label class="form-check-label" for="activeStatus">Active or Inactive</label>
                                @error('is_active')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-check form-switch mt-4">
                                <input class="form-check-input" name="is_approved" type="checkbox" role="switch" id="activeStatus" checked>
                                <label class="form-check-label" for="activeStatus">Approved or Disapproved</label>
                                @error('is_approved')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="button-group mt-4">
                                <input type="submit" class="btn btn-success" value="Store">
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('admin_script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $('.dropify').dropify();
</script>
<script>
    // District wise Upazilla Change
    $(document).ready(function() {
        $('.js-example-basic-single').select2();

        $('#pcategory_id').on('change', function() {
            var pcategory_id = $(this).val();
            if (pcategory_id) {
                $.ajax({
                    url: "{{ url('/postSubcategory/ajax') }}/" + pcategory_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        console.log(data)
                        var d = $('#subcategory_id').empty();
                        $.each(data, function(key, value) {
                            $('#subcategory_id').append('<option value="' + value.id + '">' + value.subcategory_name + '</option>');
                        });
                    },
                });
            }
        });
    });
</script>
@endpush
