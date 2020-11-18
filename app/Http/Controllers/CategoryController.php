<?php

namespace App\Http\Controllers;

use App\Category;
use Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

class CategoryController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $getCategories = Category::all();
        return view('admin.product-categories.index', compact('getCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.product-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $allInput = $request->all();
        $this->validate($request, [
            'name' => 'required',
            'image' => 'required|mimes:jpeg,bmp,png',
        ]);

        $count = Category::where('name', $request->name)->count();

        if ($count == 0) {
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = rand(11111, 99999) . $image->getClientOriginalName();
                $image_resize = Image::make($image->getRealPath())->resize(500, 150);
                $image_resize->save(public_path('images/product-category/' . $filename));
                $allInput['image'] = $filename;
            }
            $allInput['slug'] = str_slug($request->name, '-');
            Category::create($allInput);
            return redirect('admin/product-categories')->with('success', 'Product category successfully');
        } else {
            return redirect()->back()->with('error', 'Category already exists.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category) {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category, $id) {
        $category = Category::findOrfail($id);
        return view('admin.product-categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category, $id) {
        $category = Category::findOrfail($id);
        $allInput = $request->all();
        $this->validate($request, [
            'name' => 'required',
        ]);
        $count = Category::where('name', $request->name)->where('id', '!=', $id)->count();

        if ($count > 0) {
            return redirect()->back()->with('error', 'Category already exists.');
        }
        if ($request->hasFile('image')) {
            if (!empty($category->image)) {
                $catImage = public_path('images/product-category/' . $category->image);
                if (file_exists($catImage)) {
                    unlink($catImage);
                }
            }
            $image = $request->file('image');
            $filename = rand(11111, 99999) . $image->getClientOriginalName();
            $image_resize = Image::make($image->getRealPath())->resize(500, 150);
            $image_resize->save(public_path('images/product-category/' . $filename));
            $allInput['image'] = $filename;
        } else {
            $allInput['image'] = $category->image;
        }
        $allInput['slug'] = str_slug($request->name, '-');
        Category::find($id)->update($allInput);
        return redirect('admin/product-categories')->with('success', 'Product category updated successfully');


        //dd($category->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category, $id) {
        $category = Category::findOrfail($id);
        if (!empty($category->image)) {
            $catImage = public_path('images/product-category/' . $category->image);
            if (file_exists($catImage)) {
                unlink($catImage);
            }
        }
        Category::destroy($id);
        return redirect()->back()->with('success', 'Product category deleted successfully');
    }

}
