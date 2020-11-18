<?php

namespace App\Http\Controllers;

use App\CouponCode;
use Illuminate\Http\Request;

class CouponCodeController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {
        $this->middleware('auth');
    }
    public function index() {
        $getCouponCodes = CouponCode::get();
        return view('admin.coupon-code.index', compact('getCouponCodes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.coupon-code.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //dd($request->all());
        $allInput = $request->all();
        $this->validate($request, [
            'coupon_code' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'discount_percentage' => 'required',
        ]);
        $count = CouponCode::where('coupon_code', $request->coupon_code)->count();
        if ($count == 0) {
            $allInput['status'] = 1;
            CouponCode::create($allInput);
            return redirect('admin/coupon-code')->with('success', 'Coupon Code added successfully');
        } else {
            return redirect()->back()->with('error', 'Same Coupon Code already exists.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CouponCode  $couponCode
     * @return \Illuminate\Http\Response
     */
    public function show(CouponCode $couponCode) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CouponCode  $couponCode
     * @return \Illuminate\Http\Response
     */
    public function edit(CouponCode $couponCode) {
        return view('admin.coupon-code.edit', compact('couponCode'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CouponCode  $couponCode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CouponCode $couponCode) {
        //dd($request->all());
        $this->validate($request, [
            'coupon_code' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'discount_percentage' => 'required',
        ]);
        $count = CouponCode::where('coupon_code', $request->coupon_code)->where('id', '!=', $couponCode->id)->count();

        if ($count > 0) {
            return redirect()->back()->with('error', 'Coupon Code already exists.');
        }
        $updateCouponCode = $couponCode->update($request->all());
        if ($updateCouponCode) {
            return redirect('admin/coupon-code')->with('success', 'Coupon Code updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CouponCode  $couponCode
     * @return \Illuminate\Http\Response
     */
    public function destroy(CouponCode $couponCode) {
        CouponCode::destroy($couponCode->id);
        return redirect()->back()->with('success', 'Coupon Code deleted successfully');
    }

    public function inActive($id) {
        $updateStatus = CouponCode::where('id',$id)->update(['status' => 0]);
        if ($updateStatus) {
            return redirect('admin/coupon-code')->with('success', 'Coupon Code De Activated successfully');
        }
    }

    public function active($id) {
     $updateStatus = CouponCode::where('id',$id)->update(['status' => 1]);
        if ($updateStatus) {
            return redirect('admin/coupon-code')->with('success', 'Coupon Code Activated successfully');
        }   
    }
    

}
