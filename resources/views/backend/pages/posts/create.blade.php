@extends('backend.layouts.master')

@section('title')
Post Create
@endsection

@push('admin_style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css">
<style>
    .ck.ck-editor__main>.ck-editor__editable:not(.ck-focused) {
        min-height: 150px;
    }
    /* .ck.ck-editor__main>.ck-editor__editable:not(.ck-focused):focus {
        min-height: 150px;
    } */
</style>
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
                                    <option selected>Choose A Subcategory</option>
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
                                <textarea name="post_description" id="" cols="30" rows="5" class="form-control @error('post_description')
                                    is-invalid
                                @enderror"></textarea>
                                @error('post_description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label for="long_description" class="form-label">Long Description</label>
                                <textarea name="long_description" id="" cols="30" rows="5" class="form-control @error('long_description')
                                is-invalid
                                @enderror"></textarea>
                                @error('long_description')
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.2.2/axios.min.js"
integrity="sha512-QTnb9BQkG4fBYIt9JGvYmxPpd6TBeKp6lsUrtiVQsrJ9sb33Bn9s0wMQO9qVBFbPX3xHRAsBHvXlcsrnJjExjg=="
crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/35.4.0/classic/ckeditor.js"></script>
<script>
    $('.dropify').dropify();
</script>
<script>
    $('#pcategory_id').on('change', function() {
        let pcategory_id = $(this).val()
        let postSubcategories
        $('#subcategory_id').empty()
        axios.get(window.location.origin+'/admin/get-postsubcategory/'+pcategory_id).then(res=>{
            postSubcategories = res.data
            postSubcategories.map((postSubcategory, index)=>(
                $('#subcategory_id').append(`<option value="${postSubcategory.id}"> ${postSubcategory.subcategory_name} </option>`)
            ))
        })
    })
</script>
<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .then( editor => {
            console.log( editor );
        } )
        .catch( error => {
            console.error( error );
        } );
</script>
@endpush
