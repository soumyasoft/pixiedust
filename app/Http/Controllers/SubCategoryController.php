<?php

namespace App\Http\Controllers;

use App\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $getSubCategories = SubCategory::with(['category' => function($query) {
                        $query->select(['name', 'id']);
                    }])->get();
                //dd($getSubCategories);
                return view('admin.product-subcategories.index', compact('getSubCategories'));
            }

            /**
             * Show the form for creating a new resource.
             *
             * @return \Illuminate\Http\Response
             */
            public function create() {
                return view('admin.product-subcategories.create');
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
                    'category_id' => 'required',
                    'name' => 'required',
                ]);
                $count = SubCategory::where([['category_id', $request->category_id], ['name', $request->name]])->count();
                if ($count == 0) {
                    $allInput['slug'] = str_slug($request->name, '-');
                    SubCategory::create($allInput);
                    return redirect('admin/product-subcategories')->with('success', 'Product subcategory added successfully');
                } else {
                    return redirect()->back()->with('error', 'Sub Category already exists.');
                }
            }

            /**
             * Display the specified resource.
             *
             * @param  \App\SubCategory  $subCategory
             * @return \Illuminate\Http\Response
             */
            public function show(SubCategory $subCategory) {
                //
            }

            /**
             * Show the form for editing the specified resource.
             *
             * @param  \App\SubCategory  $subCategory
             * @return \Illuminate\Http\Response
             */
            public function edit(SubCategory $subCategory, $id) {
                $subCategory = SubCategory::findOrfail($id);
                return view('admin.product-subcategories.edit', compact('subCategory'));
            }

            /**
             * Update the specified resource in storage.
             *
             * @param  \Illuminate\Http\Request  $request
             * @param  \App\SubCategory  $subCategory
             * @return \Illuminate\Http\Response
             */
            public function update(Request $request, SubCategory $subCategory, $id) {
                $allInput = $request->all();
                $this->validate($request, [
                    'category_id' => 'required',
                    'name' => 'required',
                ]);
                $count = SubCategory::where([['category_id', $request->category_id], ['name', $request->name], ['id', '!=', $id]])->count();
                if ($count > 0) {
                    return redirect()->back()->with('error', 'Sub Category already exists.');
                }
                $allInput['slug'] = str_slug($request->name, '-');
                SubCategory::find($id)->update($allInput);
                return redirect('admin/product-subcategories')->with('success', 'Product subcategory updated successfully');
            }

            /**
             * Remove the specified resource from storage.
             *
             * @param  \App\SubCategory  $subCategory
             * @return \Illuminate\Http\Response
             */
            public function destroy(SubCategory $subCategory,$id) {
                SubCategory::destroy($id);
                return redirect()->back()->with('success', 'Product subcategory deleted successfully');
            }

        }
        