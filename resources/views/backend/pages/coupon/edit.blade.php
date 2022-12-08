@extends('backend.layouts.master')

@section('title')
Coupon Edit
@endsection

@push('admin_style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css">
@endpush

@section('admin_content')
    <div class="row">
        <h1>{{ __('Coupon Edit Form') }}</h1>
        <div class="col-12">
            <div class="d-flex">
                <a href="{{ route('coupon.index') }}" class="btn btn-primary">
                    <i class="fa-solid fa-backward"></i>
                    Back to Coupon list
                </a>
            </div>
        </div>
        <div class="col-12 mt-4">
            <div class="card p-4">
                <form action="{{ route('coupon.update', $coupon->id) }}" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    @method('PUT')
                    <div class="form-group">
                        <label for="coupon_name" class="form-label">Coupon title</label>
                        <input type="text" name="coupon_name" class="form-control @error('coupon_name')
                            is-invalid
                        @enderror"
                        value="{{ $coupon->coupon_name }}">
                        @error('coupon_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mt-4">
                        <label for="discount_amount" class="form-label">Discount Amount</label>
                        <input type="number" name="discount_amount" min="0" class="form-control @error('discount_amount')
                            is-invalid
                        @enderror"
                        value="{{ $coupon->discount_amount }}">
                        @error('discount_amount')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mt-4">
                        <label for="minimum_purchase_amount" class="form-label">Minimum Purchase Amount</label>
                        <input type="number" name="minimum_purchase_amount" min="0" class="form-control @error('minimum_purchase_amount')
                            is-invalid
                        @enderror"
                        value="{{ $coupon->minimum_purchase_amount }}">
                        @error('minimum_purchase_amount')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mt-4">
                        <label for="validity_till" class="form-label">Validity</label>
                        <input type="date" name="validity_till" class="form-control @error('validity_till')
                            is-invalid
                        @enderror"
                        value="{{ $coupon->validity_till }}">
                        @error('validity_till')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-check form-switch mt-4">
                        <input class="form-check-input" name="is_active" type="checkbox" role="switch" id="activeStatus"
                        @if ($coupon->is_active)
                            checked
                        @endif>
                        <label class="form-check-label" for="activeStatus">Active or Inactive</label>
                        @error('is_active')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="button-group mt-4">
                        <input type="submit" class="btn btn-success" value="Update">
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
