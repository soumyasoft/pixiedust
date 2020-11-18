<?php

namespace App\Http\Controllers;

use App\Banner;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Http\Request;

class BannerController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $getBanners = Banner::all();
        return view('admin.banners.index', compact('getBanners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.banners.create');
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
            'banner' => 'required|mimes:jpeg,bmp,png',
        ]);
        if ($request->hasFile('banner')) {
            $banner = $request->file('banner');
            $filename = rand(11111, 99999) . $banner->getClientOriginalName();
            $image_resize = Image::make($banner->getRealPath())->resize(1920, 550);
            $image_resize->save(public_path('images/banner/' . $filename));
            $allInput['banner'] = $filename;
            Banner::create($allInput);
            return redirect('admin/banners')->with('success', 'Image Upload successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner) {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner) {
        return view('admin.banners.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banner $banner) {
        //dd($banner->id);
        $id = $banner->id;
        $this->validate($request, [
            'banner' => 'required|mimes:jpeg,bmp,png',
        ]);
        if ($request->hasFile('banner')) {

            if (!empty($banner->banner)) {
                $bannerPath = public_path('images/banner/' . $banner->banner);
                if (file_exists($bannerPath)) {
                    unlink($bannerPath);
                }
            }
            $banner = $request->file('banner');
            $filename = rand(11111, 99999) . $banner->getClientOriginalName();
            $image_resize = Image::make($banner->getRealPath())->resize(1920, 550);
            $image_resize->save(public_path('images/banner/' . $filename));

            Banner::where('id', $id)
                    ->update(['banner' => $filename]);
            return redirect('admin/banners')->with('success', 'Banner image updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner) {
        $id = $banner->id;
        if (!empty($banner->banner)) {
            $bannerPath = public_path('images/banner/' . $banner->banner);
            if (file_exists($bannerPath)) {
                unlink($bannerPath);
            }
        }
        Banner::destroy($id);
        return redirect('admin/banners')->with('success', 'Banner image deleted successfully');
    }

}
