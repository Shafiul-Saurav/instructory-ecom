@extends('backend.layouts.master')

@section('title')
Testimonial Create
@endsection

@push('admin_style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css">
@endpush


@section('admin_content')
    <div class="row">
        <h1>{{ __('Testimonial Create Form') }}</h1>
        <div class="col-12">
            <div class="d-flex">
                <a href="{{ route('testimonial.index') }}" class="btn btn-primary">
                    <i class="fa-solid fa-backward"></i>
                    Back to Testimonial
                </a>
            </div>
        </div>
        <div class="col-12 mt-4">
            <div class="card p-4">
                <form action="{{ route('testimonial.store') }}" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label for="client_name" class="form-label">Client Name</label>
                        <input type="text" name="client_name" class="form-control @error('client_name')
                            is-invalid
                        @enderror" placeholder="Enter Client Name"
                        value="{{ old('client_name') }}">
                        @error('client_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mt-4">
                        <label for="client_designation" class="form-label">Client Designation</label>
                        <input type="text" name="client_designation" class="form-control @error('client_designation')
                            is-invalid
                        @enderror" placeholder="Enter Client Designation"
                        value="{{ old('client_designation') }}">
                        @error('client_designation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mt-4">
                        <label for="client_message" class="form-label">Client Message</label>
                        <textarea name="client_message" class="form-control @error('client_message')
                            is-invalid
                        @enderror" id="" cols="30" rows="5">{{ old('client_message') }}</textarea>
                        @error('client_message')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mt-4">
                        <label for="client_image" class="form-label">Client Image <span class="text-primary">Must not be greater than 512 kb</span></label>
                        <input type="file" name="client_image" class="form-control dropify @error('client_image')
                            is-invalid
                        @enderror">
                        @error('client_image')
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

@push('admin_script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
<script>
    $('.dropify').dropify();
</script>
@endpush
