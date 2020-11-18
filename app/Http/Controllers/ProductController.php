<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductImage;
use App\Category;
use Image;

class ProductController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $getProducts = Product::with(['category', 'subcategories'])->orderBy('id', "DESC")->get();
//        dd($getProducts);
        return view('admin.products.index', compact('getProducts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $subcategories = array('' => 'Select Subcategories');
        return view('admin.products.create', compact('subcategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $allInput = $request->all();
        //dd($allInput);
        $this->validate($request, [
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'shipping_price' => 'required',
            'price' => 'required',
            'meta_title' => 'required',
            'meta_keywords' => 'required',
            'meta_description' => 'required',
            'image' => 'required|mimes:jpeg,bmp,png,jpg',
            'prod_image' => 'required',
        ]);

        $count = Category::where('name', $request->name)->count();

        if ($count == 0) {
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = rand(11111, 99999) . $image->getClientOriginalName();
                $image_resize = Image::make($image->getRealPath())->resize(500, 500);
                $image_resize->save(public_path('images/products/' . $filename));
                $allInput['image'] = $filename;
            }
            $allInput['slug'] = str_slug($request->name, '-');
            $saveProduct = Product::create($allInput);

            ######## Multiple Image upload section ###########
            if ($saveProduct) {
                if ($request->hasFile('prod_image')) {
                    $prod_images = $request->file('prod_image');
                    foreach ($prod_images as $prod_image) {
                        $prod_filename = rand(11111, 99999) . $prod_image->getClientOriginalName();
                        $prod_image_resize = Image::make($prod_image->getRealPath())->resize(500, 500);
                        $prod_image_resize->save(public_path('images/products/multiple_images/' . $prod_filename));
                        $allInput['image'] = $prod_filename;
                        $allInput['product_id'] = $saveProduct->id;
                        $saveProductImage = ProductImage::create($allInput);
                    }
                }
            }
            return redirect('admin/products')->with('success', 'Product added successfully');
        } else {
            return redirect()->back()->with('error', 'Product already exists.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product) {
        $product = Product::where('id', $product->id)->with('productImages')->first();
        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product) {
        $allInput = $request->all();
//        dd($allInput);
        $this->validate($request, [
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'shipping_price' => 'required',
            'price' => 'required',
            'meta_title' => 'required',
            'meta_keywords' => 'required',
            'meta_description' => 'required',
            'image' => 'mimes:jpeg,bmp,png',
        ]);
        $count = Category::where('name', $request->name)->where('id', '!=', $product->id)->count();

        if ($count > 0) {
            return redirect()->back()->with('error', 'Product already exists.');
        }

        if ($request->hasFile('image')) {
            if (!empty($product->image)) {
                $prodImage = public_path('images/products/' . $product->image);
                if (file_exists($prodImage)) {
                    unlink($prodImage);
                }
            }
            $image = $request->file('image');
            $filename = rand(11111, 99999) . $image->getClientOriginalName();
            $image_resize = Image::make($image->getRealPath())->resize(500, 500);
            $image_resize->save(public_path('images/products/' . $filename));
            $allInput['image'] = $filename;
        } else {
            $allInput['image'] = $product->image;
        }
        $allInput['best_seller'] = $request->best_seller ? $request->best_seller : 0;
        $allInput['slug'] = str_slug($request->name, '-');
        $updateProduct = $product->update($allInput);

        if ($updateProduct) {
            if ($request->hasFile('prod_image')) {
                $prod_images = $request->file('prod_image');
                foreach ($prod_images as $prod_image) {
                    $prod_filename = rand(11111, 99999) . $prod_image->getClientOriginalName();
                    $prod_image_resize = Image::make($prod_image->getRealPath())->resize(500, 500);
                    $prod_image_resize->save(public_path('images/products/multiple_images/' . $prod_filename));
                    $allInput['image'] = $prod_filename;
                    $allInput['product_id'] = $product->id;
                    $saveProductImage = ProductImage::create($allInput);
                }
            }
        }

        return redirect('admin/products')->with('success', 'Product updated updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function showProductImageUpload() {
        return view('admin.products.product-image-upload');
    }

    public function destroy(Product $product) {
        if (!empty($product->image)) {
            $prodImage = public_path('images/products/' . $product->image);
            if (file_exists($prodImage)) {
                unlink($prodImage);
            }
        }
        $getProdMulImages = ProductImage::where('product_id', $product->id)->get();
        if ($getProdMulImages) {
            foreach ($getProdMulImages as $getProdMulImage) {
                if (!empty($getProdMulImage->image)) {
                    $prodMulImage = public_path('images/products/' . $getProdMulImage->image);
                    if (file_exists($prodImage)) {
                        unlink($prodMulImage);
                    }
                }
                ProductImage::destroy($getProdMulImage->id);
            }
        }
        Product::destroy($product->id);
        return redirect()->back()->with('success', 'Product deleted successfully');
    }

}
