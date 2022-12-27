<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Str;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use App\Models\PostSubcategory;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Intervention\Image\Facades\Image;
use App\Http\Requests\PostSubcategoryStoreRequest;
use App\Http\Requests\PostSubcategoryUpdateRequest;

class PostSubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $postSubcategories = PostSubcategory::latest('id')
        ->select(['id', 'pcategory_id', 'subcategory_name', 'subcategory_slug', 'subcategory_image',
        'is_active', 'updated_at'])->paginate(20);

        return view('backend.pages.post-subcategory.index', compact('postSubcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $postCategories = PostCategory::select(['id', 'category_name'])->get();
        return view('backend.pages.post-subcategory.create', compact('postCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostSubcategoryStoreRequest $request)
    {
        // dd($request->all());
        $postSubcategory = PostSubcategory::create([
            'pcategory_id' => $request->pcategory_id,
            'subcategory_name' => $request->subcategory_name,
            'subcategory_slug' => Str::slug($request->subcategory_name),
        ]);

        $this->image_upload($request, $postSubcategory->id);

        Toastr::success('Data Store Successfully!');
        return redirect()->route('post_subcategory.index');

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
    public function edit($subcategory_slug)
    {
        $postCategories = PostCategory::select(['id', 'category_name'])->get();
        $postSubcategory = PostSubcategory::where('subcategory_slug', $subcategory_slug)->first();
        return view('backend.pages.post-subcategory.edit', compact('postCategories', 'postSubcategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostSubcategoryUpdateRequest $request,  $subcategory_slug)
    {
        // dd($request->all());
        $postSubcategory = PostSubcategory::where('subcategory_slug', $subcategory_slug)->first();
        $postSubcategory->update([
            'pcategory_id' => $request->pcategory_id,
            'subcategory_name' => $request->subcategory_name,
            'subcategory_slug' => Str::slug($request->subcategory_name),
            'is_active' => $request->filled('is_active'),
        ]);

        $this->image_upload($request, $postSubcategory->id);

        Toastr::success('Data Update Successfully!');
        return redirect()->route('post_subcategory.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($subcategory_slug)
    {
        $postSubcategory = PostSubcategory::where('subcategory_slug', $subcategory_slug)->first();
        $postSubcategory->delete();

        Toastr::success('Data Deleted Successfully!');
        return redirect()->route('post_subcategory.index');
    }

    /**
     * Store/Update the Image file.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function image_upload($request, $postSubcategory_id)
    {
        $postSubcategory = PostSubcategory::findOrFail($postSubcategory_id);
        // dd($request->all(), $postSubcategory, $request->hasFile('subcategory_image'));
        if ($request->hasFile('subcategory_image')) {
            if ($postSubcategory->subcategory_image != 'default_subcategory.jpg') {
                //delete old photo
                $photo_location = 'public/uploads/subcategories/';
                $old_photo_location = $photo_location . $postSubcategory->subcategory_image;
                unlink(base_path($old_photo_location));
            }
            $photo_location = 'public/uploads/subcategories/';
            $uploaded_photo = $request->file('subcategory_image');
            $new_photo_name = $postSubcategory->id . '.' . $uploaded_photo->getClientOriginalExtension();
            $new_photo_location = $photo_location . $new_photo_name;
            Image::make($uploaded_photo)->resize(100,100)->save(base_path($new_photo_location), 40);
            //$user = User::find($postSubcategory->id);
            $check = $postSubcategory->update([
                'subcategory_image' => $new_photo_name,
            ]);
        }
    }
}
