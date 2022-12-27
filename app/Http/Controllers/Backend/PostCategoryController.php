<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Str;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Intervention\Image\Facades\Image;
use App\Http\Requests\PostCategoryStoreRequest;

class PostCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $postCategories = PostCategory::latest('id')
        ->select(['id', 'category_name', 'category_slug', 'pcategory_image', 'is_active', 'updated_at'])
        ->paginate(20);

        return view('backend.pages.post_category.index', compact('postCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.post_category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostCategoryStoreRequest $request)
    {
        // dd($request->all());
        $postCategory = PostCategory::create([
            'category_name' => $request->category_name,
            'category_slug' => Str::slug($request->category_name),
        ]);

        $this->image_upload($request, $postCategory->id);
        Toastr::success('Data Store Successfully!');
        return redirect()->route('post_category.index');
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
    public function edit($category_slug)
    {
        $postCategory = PostCategory::where('category_slug', $category_slug)->first();
        return view('backend.pages.post_category.edit', compact('postCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $category_slug)
    {
        // dd($request->all());
        $postCategory = PostCategory::where('category_slug', $category_slug)->first();
        $postCategory->update([
            'category_name' => $request->category_name,
            'category_slug' => Str::slug($request->category_name),
            'is_active' => $request->filled('is_active'),
        ]);

        $this->image_upload($request, $postCategory->id);
        Toastr::success('Data Updated Successfully');
        return redirect()->route('post_category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($category_slug)
    {
        $postCategory = PostCategory::where('category_slug', $category_slug)->first();
        $postCategory->delete();

        Toastr::success('Data Deleted Successfully');
        return redirect()->route('post_category.index');
    }

    /**
     * Store/Update the Image file.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function image_upload($request, $postCategory_id)
    {
        $postCategory = PostCategory::findOrFail($postCategory_id);
        // dd($request->all(), $postCategory, $request->hasFile('pcategory_image'));
        if ($request->hasFile('pcategory_image')) {
            if ($postCategory->pcategory_image != 'default_pcategory.jpg') {
                //delete old photo
                $photo_location = 'public/uploads/pcategories/';
                $old_photo_location = $photo_location . $postCategory->pcategory_image;
                unlink(base_path($old_photo_location));
            }
            $photo_location = 'public/uploads/pcategories/';
            $uploaded_photo = $request->file('pcategory_image');
            $new_photo_name = $postCategory->id . '.' . $uploaded_photo->getClientOriginalExtension();
            $new_photo_location = $photo_location . $new_photo_name;
            Image::make($uploaded_photo)->resize(600,600)->save(base_path($new_photo_location), 40);
            //$user = User::find($postCategory->id);
            $check = $postCategory->update([
                'pcategory_image' => $new_photo_name,
            ]);
        }
    }


}
