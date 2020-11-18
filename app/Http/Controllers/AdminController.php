<?php

namespace App\Http\Controllers;

use App\User;
use App\PaymentSetting;
use App\UserRegistration;
use App\MasterOrder;
use App\ServiceSchedule;
use App\IntutivePriceSetting;
use App\MassagePriceSetting;
use Auth;
use Session;
use Hash;
use Illuminate\Http\Request;

class AdminController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $getTotalUsersCount = UserRegistration::count();
        $getTotalOrdersCount = MasterOrder::where('transaction_id', '!=', NULL)->count();
        return view('admin.home', compact('getTotalUsersCount', 'getTotalOrdersCount'));
    }

    public function showMyaccount() {
        $getAccountDetails = User::where('id', Auth::user()->id)->first();
        return view('admin.my-account', compact('getAccountDetails'));
    }

    public function updateMyaccount(Request $request) {
        //dd($request->all());
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'alt_email' => 'required',
            'contact_no' => 'required',
            'address' => 'required',
            'opening_hours' => 'required',
            'facebook_url' => 'required|url',
            'twitter_url' => 'required|url',
            'instagram_url' => 'required|url',
        ]);
        $data = request()->except(['_token']);
        $profileUpdate = User::where('id', Auth::user()->id)
                ->update($data);
        if ($profileUpdate) {
            $request->session()->flash('success', 'My Account updated successfully.');
            return back();
        } else {
            $request->session()->flash('error', 'Error occured updation.');
            return back();
        }
    }

    public function showChangePassword() {
        return view('admin.change-password');
    }

    public function changePassword(Request $request) {
        $this->validate($request, [
            'current_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required|same:new_password',
        ]);
        $user = User::find(auth()->user()->id);
        if (Hash::check($request->current_password, $user->password)) {
            $user->fill(['password' => Hash::make($request->new_password)])->save();
            $request->session()->flash('success', 'Password changed successfully.');
            return back();
        } else {
            $request->session()->flash('error', 'Please enter your correct old password.');
            return back();
        }
    }

    public function getNewsLetter() {
        $getNewsLetSubEmails = \App\NewsLetter::orderBy('id', 'DESC')->get();
        return view('admin.newsletter', compact('getNewsLetSubEmails'));
    }

    public function sendNewsLetter(Request $request) {
        
    }

    public function paymentSetting() {
        $getPaymentSetting = PaymentSetting::first();
        return view('admin.payment-setting', compact('getPaymentSetting'));
    }

    public function updatePaymentSetting(Request $request) {
        $this->validate($request, [
            'paypal_environment' => 'required',
            'paypal_email' => 'required|email',
        ]);
        $data = request()->except(['_token']);
        $paymentSettingUpdate = PaymentSetting::where('id', 1)
                ->update($data);
        if ($paymentSettingUpdate) {
            $request->session()->flash('success', 'PaymentSetting updated successfully.');
            return back();
        } else {
            $request->session()->flash('error', 'Error occured updation.');
            return back();
        }
    }

    public function showCustomers() {
        $getCustomers = UserRegistration::orderBy('id', 'DESC')->get();
        return view('admin.manage-customers', compact('getCustomers'));
    }

    public function viewCustomerDetails($id) {
        $getCustomerDetails = UserRegistration::where('id', $id)->first();
        return view('admin.view-customer-details', compact('getCustomerDetails'));
    }

    public function showOrders() {
        $getOrders = MasterOrder::where('transaction_id', '!=', NULL)->get();
        return view('admin.manage-orders', compact('getOrders'));
    }

    public function viewOrderDetails($id) {
        $getOrderDetails = MasterOrder::where('id', $id)->with('orderItems')->first();
        return view('admin.view-order-details', compact('getOrderDetails'));
    }

    public function showIntutiveReaders() {
        $getIntutiveReaders = ServiceSchedule::where('id', 1)->first();
        return view('admin.intutive-readers', compact('getIntutiveReaders'));
    }

    public function editIntutiveReaders($id) {
        $getIntutiveReaders = ServiceSchedule::where('id', 1)->first();
        return view('admin.intutive-readers-edit', compact('getIntutiveReaders'));
    }

    public function updateIntutiveReaders(Request $request) {
        $allInput = request()->except(['_token']);
        $this->validate($request, [
            'description' => 'required',
        ]);
        $intutiveReaders = ServiceSchedule::where('id', 1)
                ->update($allInput);
        if ($intutiveReaders) {
            return redirect('admin/intutive-readers')->with('success', 'Intutive Readers updated successfully');
        } else {
            $request->session()->flash('error', 'Error occured updation.');
            return back();
        }
    }

    public function showMassageTherapists() {
        $getMassageTherapists = ServiceSchedule::where('id', 2)->first();
        return view('admin.massage-therapists', compact('getMassageTherapists'));
    }

    public function editMassageTherapists($id) {
        $getMassageTherapists = ServiceSchedule::where('id', 2)->first();
        return view('admin.massage-therapists-edit', compact('getMassageTherapists'));
    }

    public function updateMassageTherapists(Request $request) {
        $allInput = request()->except(['_token']);
        $this->validate($request, [
            'description' => 'required',
        ]);
        $massageTherapists = ServiceSchedule::where('id', 2)
                ->update($allInput);
        if ($massageTherapists) {
            return redirect('admin/massage-therapists')->with('success', 'Massage Therapists updated successfully');
        } else {
            $request->session()->flash('error', 'Error occured updation.');
            return back();
        }
    }

    public function showIntutivePrices() {
        $getIntutivePrices = IntutivePriceSetting::get();
        return view('admin.intutive-reading-price', compact('getIntutivePrices'));
    }

    public function editIntutivePriceSetting($id) {
        $getIntutivePrices = IntutivePriceSetting::where('id', $id)->first();
        return view('admin.intutive-reading-price-edit', compact('getIntutivePrices'));
    }

    public function updateIntutivePrice(Request $request) {
        $allInput = request()->except(['_token']);
        $this->validate($request, [
            'price' => 'required',
        ]);
        $intutiveReadingPriceUpdate = IntutivePriceSetting::where('id', $request->id)->update($allInput);
        if ($intutiveReadingPriceUpdate) {
            return redirect('admin/intutive-price-setting')->with('success', 'Intutive Reading Price updated successfully');
        } else {
            $request->session()->flash('error', 'Error occured updation.');
            return back();
        }
    }
    
    
    ############### Massage Therapy Settings #########################
    
    public function showMassageTherapyPrices() {
        $getMassageTherapyPrices = MassagePriceSetting::get();
        return view('admin.massage-therapy-price', compact('getMassageTherapyPrices'));
    }

    public function editMassageTherapyPriceSetting($id) {
        $getMassagePriceSetting = MassagePriceSetting::where('id', $id)->first();
        return view('admin.massage-therapy-price-edit', compact('getMassagePriceSetting'));
    }

    public function updateMassageTherapyPrice(Request $request) {
        $allInput = request()->except(['_token']);
        $this->validate($request, [
            'price' => 'required',
        ]);
        $massagePriceSettingUpdate = MassagePriceSetting::where('id', $request->id)->update($allInput);
        if ($massagePriceSettingUpdate) {
            return redirect('admin/massage-therapists-price-setting')->with('success', 'Massage Price Price updated successfully');
        } else {
            $request->session()->flash('error', 'Error occured updation.');
            return back();
        }
    }
    
    
    

}
