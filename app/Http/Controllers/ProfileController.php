<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Upazila;
use App\Models\District;
use App\Models\Division;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $divisions = Division::select(['id', 'name'])->get();
        // dd($divisions);
        $profile = Profile::where('user_id', Auth::id())->first();
        return view('frontend.pages.profile.profile', compact('divisions', 'profile'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('frontend.pages.profile.profile');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProfileUpdateRequest $request)
    {
        // dd($request->all());
        $profile = $request->all();
        $profile['user_id'] = Auth::id();

        $existing_profile = Profile::where('user_id', Auth::id())->first();
        if ($existing_profile) {
            $existing_profile->update($profile);
        } else {
            $profile = Profile::create([
            'user_id' => Auth::id(),
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'upazila_id' => $request->upazila_id,
            'address' => $request->address,
            'gender' => $request->gender,
        ]);
        $this->image_upload($request, $profile->id);
        }



        Toastr::success('Profile Updated Successfully!');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getDistrict($division_id)
    {
        $districts = District::select(['id', 'name'])->where('division_id', $division_id)->get();
        return response()->json($districts);
    }

    public function getUpazila($district_id)
    {
        $upazilas = Upazila::select(['id', 'name'])->where('district_id', $district_id)->get();
        return response()->json($upazilas);
    }

    /**
     * Store/Update the Image file.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function image_upload($request, $profile_id)
    {
        $profile = Profile::findOrFail($profile_id);
        // dd($request->all(), $profile, $request->hasFile('user_image'));
        if ($request->hasFile('user_image')) {
            if ($profile->user_image != 'default_user.jpg') {
                //delete old photo
                $photo_location = 'public/uploads/users/';
                $old_photo_location = $photo_location . $profile->user_image;
                unlink(base_path($old_photo_location));
            }
            $photo_location = 'public/uploads/users/';
            $uploaded_photo = $request->file('user_image');
            $new_photo_name = $profile->id . '.' . $uploaded_photo->getClientOriginalExtension();
            $new_photo_location = $photo_location . $new_photo_name;
            Image::make($uploaded_photo)->resize(100,100)->save(base_path($new_photo_location), 40);
            //$user = User::find($profile->id);
            $check = $profile->update([
                'user_image' => $new_photo_name,
            ]);
        }
    }
}
