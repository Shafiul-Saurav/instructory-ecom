<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Intervention\Image\Facades\Image;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest('id')->select(['id', 'title', 'slug', 'category_image', 'is_active', 'updated_at'])->paginate();
        // return $categories;
        return view('backend.pages.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryStoreRequest $request)
    {
        // dd($request->all());
        $category = Category::create([
            'title' => $request->category_title,
            'slug' => Str::slug($request->category_title),
        ]);

        $this->image_upload($request, $category->id);
        Toastr::success('Data Store Successfully!');
        return redirect()->route('category.index');
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
    public function edit($slug)
    {
        $category = Category::whereSlug($slug)->first();
        // return $category;
        return view('backend.pages.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryUpdateRequest $request, $slug)
    {
        // dd($slug);
        $category = Category::whereSlug($slug)->first();
        $category->update([
            'title' => $request->category_title,
            'slug' => Str::slug($request->category_title),
            'is_active' => $request->filled('is_active'),
        ]);

        $this->image_upload($request, $category->id);
        Toastr::success('Data Updated Successfully!');
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $category = Category::whereSlug($slug)->first();
        $category->delete();

        Toastr::success('Data Deleted Successfully!');
        return redirect()->route('category.index');
    }

    public function image_upload($request, $category_id)
    {
        $category = Category::findOrFail($category_id);
        // dd($request->all(), $category, $request->hasFile('category_image'));
        if ($request->hasFile('category_image')) {
            if ($category->category_image != 'category-default.png') {
                //delete old photo
                $photo_location = 'public/uploads/categories/';
                $old_photo_location = $photo_location . $category->category_image;
                unlink(base_path($old_photo_location));
            }
            $photo_location = 'public/uploads/categories/';
            $uploaded_photo = $request->file('category_image');
            $new_photo_name = $category->id . '.' . $uploaded_photo->getClientOriginalExtension();
            $new_photo_location = $photo_location . $new_photo_name;
            Image::make($uploaded_photo)->resize(600,470)->save(base_path($new_photo_location), 40);
            //$user = User::find($category->id);
            $check = $category->update([
                'category_image' => $new_photo_name,
            ]);
        }
    }
}
