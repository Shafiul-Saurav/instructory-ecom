@extends('backend.layouts.master')

@section('title')
Product Edit
@endsection

@push('admin_style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css">
@endpush


@section('admin_content')
    <div class="row">
        <h1>{{ __('Product Edit Form') }}</h1>
        <div class="col-12">
            <div class="d-flex">
                <a href="{{ route('product.index') }}" class="btn btn-primary">
                    <i class="fa-solid fa-backward"></i>
                    Back to Product List
                </a>
            </div>
        </div>
        <div class="col-12 mt-4">
            <div class="card p-4">
                <form action="{{ route('product.update', $product->slug) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="category-name" class="form-label">Category Name</label>
                                <select name="category_id" id="" class="form-select">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" @if ($category->id == $product->category_id)
                                            selected
                                        @endif>{{ $category->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group mt-4">
                                <label for="product_name" class="form-label">Product Name</label>
                                <input type="text" name="product_name" class="form-control @error('product_name')
                                    is-invalid
                                @enderror" placeholder="Enter Product Name" value="{{ $product->name }}">
                                @error('product_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group mt-4">
                                <label for="product_price" class="form-label">Product Price</label>
                                <input type="number" name="product_price" class="form-control @error('product_price')
                                    is-invalid
                                @enderror" min="0" value="{{ $product->product_price }}">
                                @error('product_price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group mt-4">
                                <label for="product_code" class="form-label">Product Code</label>
                                <input type="text" name="product_code" class="form-control @error('product_code')
                                    is-invalid
                                @enderror" placeholder="Enter a Unique Product Code" value="{{ $product->product_code }}">
                                @error('product_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group mt-4">
                                <label for="product_stock" class="form-label">Initial Stock</label>
                                <input type="number" name="product_stock" class="form-control @error('product_stock')
                                    is-invalid
                                @enderror" min="1" value="{{ $product->product_stock }}">
                                @error('product_stock')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group mt-4">
                                <label for="alert_quantity" class="form-label">Alert Quantity</label>
                                <input type="number" name="alert_quantity" class="form-control @error('alert_quantity')
                                    is-invalid
                                @enderror" min="1" value="{{ $product->alert_quantity }}">
                                @error('alert_quantity')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group mt-4">
                                <label for="short_description" class="form-label">Short Description</label>
                                <textarea name="short_description" class="form-control @error('short_description')
                                    is-invalid
                                @enderror" id="" cols="30" rows="5">{{ $product->short_description }}</textarea>
                                @error('short_description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group mt-4">
                                <label for="long_description" class="form-label">Long Description</label>
                                <textarea name="long_description" class="form-control @error('long_description')
                                    is-invalid
                                @enderror" id="" cols="30" rows="5">{{ $product->long_description }}</textarea>
                                @error('long_description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group mt-4">
                                <label for="additional_info" class="form-label">Additional Info</label>
                                <textarea name="additional_info" class="form-control @error('additional_info')
                                    is-invalid
                                @enderror" id="" cols="30" rows="5">{{ $product->additional_info }}</textarea>
                                @error('additional_info')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group mt-4">
                                <label for="product_image" class="form-label">Product Image</label>
                                <input type="file" name="product_image" class="form-control dropify"
                                data-default-file="{{ asset('uploads/products') }}/{{ $product->product_image }}">
                                @error('product_image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group mt-4">
                                <label for="product_multiple_image" class="form-label">Product Image</label>
                                <input type="file" name="product_multiple_image[]" class="form-control" multiple>
                                @error('product_multiple_image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check form-switch mt-4">
                                <input class="form-check-input" name="is_active" type="checkbox" role="switch" id="activeStatus" @if ($product->is_active)
                                    checked
                                @endif>
                                <label class="form-check-label" for="activeStatus">Active or Inactive</label>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="button-group mt-4">
                            <input type="submit" class="btn btn-success" value="Update">
                        </div>
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
