<?php

namespace App\Http\Controllers\Backend;

use App\Models\Post;
use Illuminate\Support\Str;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use App\Models\PostSubcategory;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('user')->latest('id')->select(['id', 'pcategory_id', 'subcategory_id', 'user_id',
        'post_name', 'post_slug', 'post_description','long_description', 'post_image', 'is_approved', 'is_active',
        'admin_comment', 'updated_at'])->paginate(20);

        return view('backend.pages.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $postCategories = PostCategory::select(['id', 'category_name'])->get();
        return view('backend.pages.posts.create', compact('postCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostStoreRequest $request)
    {
        // dd($request->all());
        $post = Post::create([
            'pcategory_id' => $request->pcategory_id,
            'subcategory_id' => $request->subcategory_id,
            'user_id' => Auth::user()->id,
            'post_name' => $request->post_name,
            'post_slug' => Str::slug($request->post_name),
            'post_description' => $request->post_description,
            'long_description' => $request->long_description,
        ]);

        $this->image_upload($request, $post->id);

        Toastr::success('Data Created Successfully!');
        return redirect()->route('post.index');
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
    public function edit($post_slug)
    {
        $postCategories = PostCategory::select(['id', 'category_name'])->get();
        $postSubcategories = PostSubcategory::select(['id', 'subcategory_name'])->get();
        $post = Post::where('post_slug', $post_slug)->first();

        return view('backend.pages.posts.edit', compact('postCategories', 'postSubcategories', 'post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostUpdateRequest $request, $post_slug)
    {
        // dd($request->all());
        $post = Post::where('post_slug', $post_slug)->first();
        $post->update([
            'pcategory_id' => $request->pcategory_id,
            'subcategory_id' => $request->subcategory_id,
            'user_id' => Auth::user()->id,
            'post_name' => $request->post_name,
            'post_slug' => Str::slug($request->post_name),
            'post_description' => $request->post_description,
            'long_description' => $request->long_description,
            'is_approved' => $request->filled('is_approved'),
            'is_active' => $request->filled('is_active'),
        ]);

        $this->image_upload($request, $post->id);

        Toastr::success('Data Updated Successfully!');
        return redirect()->route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($post_slug)
    {
        $post = Post::where('post_slug', $post_slug)->first();
        $post->delete();

        Toastr::success('Data Updated Successfully!');
        return redirect()->route('post.index');
    }

    /**
     * Store/Update the Image file.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function image_upload($request, $post_id)
    {
        $post = Post::findOrFail($post_id);
        // dd($request->all(), $post, $request->hasFile('post_image'));
        if ($request->hasFile('post_image')) {
            if ($post->post_image != 'default_post.jpg') {
                //delete old photo
                $photo_location = 'public/uploads/posts/';
                $old_photo_location = $photo_location . $post->post_image;
                unlink(base_path($old_photo_location));
            }
            $photo_location = 'public/uploads/posts/';
            $uploaded_photo = $request->file('post_image');
            $new_photo_name = $post->id . '.' . $uploaded_photo->getClientOriginalExtension();
            $new_photo_location = $photo_location . $new_photo_name;
            Image::make($uploaded_photo)->resize(870,500)->save(base_path($new_photo_location), 40);
            //$user = User::find($post->id);
            $check = $post->update([
                'post_image' => $new_photo_name,
            ]);
        }
    }

}
