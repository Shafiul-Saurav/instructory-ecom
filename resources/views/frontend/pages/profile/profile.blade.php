@extends('frontend.layouts.master')

@section('frontendtitle') Login Page @endsection

@push('frontend_style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css">
@endpush

@section('frontend_content')
   @include('frontend.layouts.inc.breadcrumb', ['pagename' => Auth::user()->name])
   <div class="account-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>Additional Info Setting</h2>
            </div>
        </div>
        @if ($profile)
        <div class="row">
            <div class="col-lg-8">
                <form action="{{ route('profile.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group mt-3">
                                <label for="user_image" class="form-label">Profile Image <span class="text-danger">*</span></label>
                                <input type="file" name="user_image" class="form-control dropify @error('user_image')
                                    is-invalid
                                @enderror"
                                data-default-file="{{ asset('uploads/users') }}/{{ $profile->user_image }}">
                                @error('user_image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mt-3">
                                <label for="division_id" class="form-label">Division <span class="text-danger">*</span></label>
                                <select id="division_id" name="division_id" class="form-control js-example-basic-single">
                                    <option value="1">Select a Division</option>
                                    @foreach ($divisions as $division)
                                    <option value="{{ $division->id }}"@if ($division->id == $profile->division_id)
                                        selected
                                    @endif>{{ $division->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        {{-- For District --}}
                        <div class="col-md-4">
                            <div class="form-group mt-3">
                                <label for="district_id" class="form-label">District <span class="text-danger">*</span></label>
                                <select id="district_id" name="district_id" class="form-control js-example-basic-single" disabled>
                                    <option value="1">Select a district</option>
                                </select>
                            </div>
                        </div>
                        {{-- For Thana/Upazila --}}
                        <div class="col-md-4">
                            <div class="form-group mt-3">
                                <label for="upazila_id" class="form-label">Thana <span class="text-danger">*</span></label>
                                <select id="upazila_id" name="upazila_id" class="form-control js-example-basic-single" disabled>
                                    <option value="1">Select a Thana</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mt-3">
                                <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
                                <textarea name="address" id="" cols="30" rows="5" class="form-control">{{ $profile->address }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-12 mt-3">
                            <label for="" class="form-label">Select Gender <span class="text-danger">*</span></label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input ml-4 mt-2" type="radio" name="gender" id="inlineRadio1" value="male">
                                <label class="form-check-label ml-4" for="inlineRadio1">Male</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input ml-4 mt-2" type="radio" name="gender" id="inlineRadio2" value="female">
                                <label class="form-check-label ml-4" for="inlineRadio2">Female</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input ml-4 mt-2" type="radio" name="gender" id="inlineRadio3" value="other">
                                <label class="form-check-label ml-4" for="inlineRadio3">Other</label>
                              </div>
                        </div>
                        <div class="col-md-12">
                            <div class="button-group mt-3">
                                <button type="submit" class="btn btn-danger">Update</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-4">
                <table class="table table-striped table-bordered table-hover">
                    <tbody>
                        <tr><th colspan="2"><h3>Your Information</h3></th></tr>
                        <tr>
                            <th>Profile Image</th>
                            <td>
                                <img src="{{ asset('uploads/users') }}/{{ $profile->user_image }}"
                                class="img-fluid" alt="" style="width:100px; height:100px;">
                            </td>
                        </tr>
                        <tr>
                            <th>Your Name</th>
                            <td>{{ $profile->user->name }}</td>
                        </tr>
                        <tr>
                            <th>Your Email</th>
                            <td>{{ $profile->user->email }}</td>
                        </tr>
                        <tr>
                            <th>Your Phone</th>
                            <td>{{ $profile->user->phone }}</td>
                        </tr>
                        <tr>
                            <th>Gender</th>
                            <td>{{ $profile->gender }}</td>
                        </tr>
                        <tr>
                            <th>Division</th>
                            <td>{{ $profile->division->name }}</td>
                        </tr>
                        <tr>
                            <th>District</th>
                            <td>{{ $profile->district->name }}</td>
                        </tr>
                        <tr>
                            <th>Upazila</th>
                            <td>{{ $profile->upazila->name }}</td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td>{{ $profile->address }}</td>
                        </tr>
                        <tr>
                            <th>Joining Date</th>
                            <td>{{ $profile->user->created_at }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
         @else
         <div class="row">
            <div class="col-lg-8">
                <form action="{{ route('profile.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group mt-3">
                                <label for="user_image" class="form-label">Profile Image <span class="text-danger">*</span></label>
                                <input type="file" name="user_image" class="form-control dropify @error('user_image')
                                    is-invalid
                                @enderror" placeholder="Enter Category Title"
                                data-default-file="">
                                @error('user_image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mt-3">
                                <label for="division_id" class="form-label">Division <span class="text-danger">*</span></label>
                                <select id="division_id" name="division_id" class="form-control js-example-basic-single">
                                    <option value="1">Select a Division</option>
                                    @foreach ($divisions as $division)
                                    <option value="{{ $division->id }}">{{ $division->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mt-3">
                                <label for="district_id" class="form-label">District <span class="text-danger">*</span></label>
                                <select id="district_id" name="district_id" class="form-control js-example-basic-single" disabled>
                                    <option value="1">Select a district</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mt-3">
                                <label for="upazila_id" class="form-label">Thana <span class="text-danger">*</span></label>
                                <select id="upazila_id" name="upazila_id" class="form-control js-example-basic-single" disabled>
                                    <option value="1">Select a Thana</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mt-3">
                                <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
                                <textarea name="address" id="" cols="30" rows="5" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12 mt-3">
                            <label for="" class="form-label">Select Gender <span class="text-danger">*</span></label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input ml-4 mt-2" type="radio" name="gender" id="inlineRadio1" value="male">
                                <label class="form-check-label ml-4" for="inlineRadio1">Male</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input ml-4 mt-2" type="radio" name="gender" id="inlineRadio2" value="female">
                                <label class="form-check-label ml-4" for="inlineRadio2">Female</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input ml-4 mt-2" type="radio" name="gender" id="inlineRadio3" value="other">
                                <label class="form-check-label ml-4" for="inlineRadio3">Other</label>
                              </div>
                        </div>
                        <div class="col-md-12">
                            <div class="button-group mt-3">
                                <button type="submit" class="btn btn-danger">Update</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-4">
                <table class="table table-striped table-bordered table-hover">
                    <tbody>
                        <tr><th colspan="2"><h3>Your Information</h3></th></tr>
                        <tr>
                            <th>Profile Image</th>
                            <td>
                                <img src="{{ asset('uploads/users') }}/default_user.jpg"
                                class="img-fluid" alt="" style="width:100px; height:100px;">
                            </td>
                        </tr>
                        <tr>
                            <th>Your Name</th>
                            <td>{{ Auth::user()->name }}</td>
                        </tr>
                        <tr>
                            <th>Your Email</th>
                            <td>{{ Auth::user()->email }}</td>
                        </tr>
                        <tr>
                            <th>Your Phone</th>
                            <td>{{ Auth::user()->phone }}</td>
                        </tr>
                        <tr>
                            <th>Joining Date</th>
                            <td>{{ Auth::user()->created_at }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        @endif

    </div>
</div>

@php
    if ($profile) {
        $profile_exist = 1;
    } else {
        $profile_exist = 0;
    }
@endphp
@endsection
@push('frontend_script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.2.2/axios.min.js"
integrity="sha512-QTnb9BQkG4fBYIt9JGvYmxPpd6TBeKp6lsUrtiVQsrJ9sb33Bn9s0wMQO9qVBFbPX3xHRAsBHvXlcsrnJjExjg=="
crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $('.dropify').dropify();
</script>
<script>
    // To Get District Data
    const getDistricts = (division_id, selected = null) => {
        axios.get(`${window.location.origin}/get-districts/${division_id}`).then(res=>{
            let districts = res.data
            let element = $('#district_id')
            let upazila_element = $('#upazila_id').empty().append(`<option>Select a Thana</option>`).attr('disabled', 'disabled')
            element.removeAttr('disabled')
            element.empty()
            element.append(`<option>Select a District</option>`)
            districts.map((district, index)=>{
                // console.log(district)
                element.append(`<option value="${district.id}" ${selected == district.id ?'selected' : ''}>${district.name}</option>`)
            })
        })
    }

    $('#division_id').on('change', function() {
        getDistricts($(this).val())
    })

    // To Get Thana/Upazila Data
    const getUpazilas = (district_id, selected = null) => {
        axios.get(`${window.location.origin}/get-upazilas/${district_id}`).then(res=>{
            let upazilas = res.data
            let element = $('#upazila_id')
            element.removeAttr('disabled')
            element.empty()
            element.append(`<option>Select a Thana</option>`)
            upazilas.map((upazila, index)=>{
                // console.log(district)
                element.append(`<option value="${upazila.id}" ${selected == upazila.id ?'selected' : ''}>${upazila.name}</option>`)
            })
        })
    }

    $('#district_id').on('change', function() {
        getUpazilas($(this).val())
    })

    if('{{$profile_exist}}' == 1){
        getDistricts('{{$profile?->division_id}}', '{{$profile?->district_id}}')
        getUpazilas('{{$profile?->district_id}}', '{{$profile?->upazila_id}}')
    }
</script>
@endpush
