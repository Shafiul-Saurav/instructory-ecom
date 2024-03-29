<?php

namespace App\Http\Controllers\Backend;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Intervention\Image\Facades\Image;
use App\Http\Requests\ProductStoreRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::where('is_active', 1)
        ->with('category')
        ->latest('id')
        ->select(['id', 'category_id', 'name', 'slug', 'product_price', 'product_stock',
         'alert_quantity', 'product_image', 'product_rating', 'is_active', 'updated_at'])
         ->paginate(30);
        //  return $products;
        return view('backend.pages.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::select(['id', 'title'])->get();
        return view('backend.pages.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStoreRequest $request)
    {
        // dd($request->all());
        $product = Product::create([
            'category_id' => $request->category_id,
            'name' => $request->product_name,
            'slug' => Str::slug($request->product_name),
            'product_price' =>$request->product_price,
            'product_code' =>$request->product_code,
            'product_stock' =>$request->product_stock,
            'alert_quantity' =>$request->alert_quantity,
            'short_description' =>$request->short_description,
            'long_description' =>$request->long_description,
            'additional_info' =>$request->additional_info,
        ]);

        $this->image_upload($request, $product->id);
        $this->multiple_image__upload($request, $product->id);

        Toastr::success('Product Created Successfully!');
        return redirect()->route('product.index');
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
        $categories = Category::select(['id', 'title'])->get();
        $product = Product::where('slug', $slug)->first();
        return view('backend.pages.product.edit', compact('categories', 'product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        // dd($slug);
        $product = Product::where('slug', $slug)->first();
        $product->update([
            'category_id' => $request->category_id,
            'name' => $request->product_name,
            'slug' => Str::slug($request->product_name),
            'product_price' =>$request->product_price,
            'product_code' =>$request->product_code,
            'product_stock' =>$request->product_stock,
            'alert_quantity' =>$request->alert_quantity,
            'short_description' =>$request->short_description,
            'long_description' =>$request->long_description,
            'additional_info' =>$request->additional_info,
            'is_active' => $request->filled('is_active'),
        ]);

        $this->image_upload($request, $product->id);
        $this->multiple_image__upload($request, $product->id);

        Toastr::success('Product Updated Successfully!');
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $product = Product::where('slug', $slug)->first();
        $product->delete();

        Toastr::success('Product Deleted Successfully!');
        return redirect()->route('product.index');
    }

    public function image_upload($request, $product_id)
    {
        $product = Product::findOrFail($product_id);
        // dd($request->all(), $product, $request->hasFile('product_image'));
        if ($request->hasFile('product_image')) {
            if ($product->product_image != 'default_product.jpg') {
                //delete old photo
                $photo_location = 'public/uploads/products/';
                $old_photo_location = $photo_location . $product->product_image;
                unlink(base_path($old_photo_location));
            }
            $photo_location = 'public/uploads/products/';
            $uploaded_photo = $request->file('product_image');
            $new_photo_name = $product->id . '.' . $uploaded_photo->getClientOriginalExtension();
            $new_photo_location = $photo_location . $new_photo_name;
            Image::make($uploaded_photo)->resize(600,500)->save(base_path($new_photo_location), 40);
            //$user = User::find($product->id);
            $check = $product->update([
                'product_image' => $new_photo_name,
            ]);
        }
    }

    public function multiple_image__upload($request, $product_id)
    {
        if ($request->hasFile('product_multiple_image')) {

            // delete old photo first
            $multiple_images = ProductImage::where('product_id', $product_id)->get();
            foreach ($multiple_images as $multiple_image) {
                if ($multiple_image->product_multiple_photo_name != 'default_product.jpg') {
                    //delete old photo
                    $photo_location = 'public/uploads/products/';
                    $old_photo_location = $photo_location . $multiple_image->product_multiple_photo_name;
                    unlink(base_path($old_photo_location));
                }
                // delete old value of db table
                $multiple_image->delete();
            }

            $flag = 1; // Assign a flag variable

            foreach ($request->file('product_multiple_image') as $single_photo) {
                $photo_location = 'public/uploads/products/';
                $new_photo_name = $product_id.'-'.$flag.'.'. $single_photo->getClientOriginalExtension();
                $new_photo_location = $photo_location . $new_photo_name;
                Image::make($single_photo)->resize(600, 500)->save(base_path($new_photo_location), 40);
                ProductImage::create([
                    'product_id' => $product_id,
                    'product_multiple_image' => $new_photo_name,
                ]);
                $flag++;
            }
        }
    }
}
