<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserRegistration;
use \App\TempCart;
use App\MasterOrder;
use App\OrderItem;
use Hash;
use Mail;
use Redirect;
use Response;
use Illuminate\Support\Str;

class UserController extends Controller {

    public function userLogin() {
        return view('login');
    }

    public function userLoginProcess(Request $request) {

        if ($request->email) {
            $user_email = trim($request->input('email'));
        } else {
            $user_email = trim($request->input('user_email'));
        }
        $user_password = trim($request->input('user_password'));
        ###### Validation Check #####        
        if ($user_email == "" || $user_password == "") {
            return Response::json(['status' => 'ep_blank', 'msg' => "Please enter email and password."]);
        }
        ########## Record check from user registration #################
        $getUserData = UserRegistration::where('email', $user_email)->first();

        if (count($getUserData) == 0 || (Hash::check($user_password, $getUserData->user_password) == FALSE) || $getUserData->user_status == 0) {
            return Response::json(['status' => 'ep_invalid', 'msg' => "Invalid login credentials."]);
        } else {
// Store in SESSION
            session(['user_id' => $getUserData->id]);
            session(['user_name' => $getUserData->bill_first_name]);
            $session_id = session()->getId();

//check is there any item added by user in this session
            $count = TempCart::where('session_id', $session_id)->count();
//if any item is added by the user then update cart with user id & then return to the confirm order page	
            if ($count > 0) {
                $updateSessId = TempCart::where('session_id', $session_id)->update(['user_id' => $getUserData->id]);
            }
            return Response::json(['status' => 'login_success', 'msg' => "Login Successfully."]);
        }
    }

    public function userLogout() {
        $session_id = session()->getId();
        $deleteSessdata = TempCart::where('session_id', $session_id)->delete();
//Delete data from master order & order items table if transaction id is blank
        $user_id = session()->get('user_id');
        $orderInfos = MasterOrder::where([['user_id' => $user_id], ['transaction_id' => NULL]]);
//print_r($order_info);exit;

        foreach ($orderInfos as $orderInfo) {
            MasterOrder::where('id', '=', $orderInfo->id)->delete();
            OrderItem::where('order_id', $orderInfo->id)->delete();
        }
        session()->flush();
        return Redirect::to('/');
    }

    public function showChangePassword() {
        return view('change-password');
    }

    public function updatePassword(Request $request) {
        $this->validate($request, [
            'old_password' => 'required',
            'new_password' => 'required',
            'conf_password' => 'required|same:new_password',
        ]);
        $user = UserRegistration::where('id', session()->get('user_id'))->select('id', 'user_password')->first();
        if (Hash::check($request->old_password, $user->user_password)) {
            $user->fill(['user_password' => Hash::make($request->new_password)])->save();
            return redirect()->back()->with('success', 'Password changed successfully.');
        } else {
            return redirect()->back()->with('error', 'Please enter your correct old password.');
        }
    }

    public function showMyAccount() {
        $getUserDetails = UserRegistration::where('id', session()->get('user_id'))->first();
        $getOrderDetails = MasterOrder::where('user_id', session()->get('user_id'))->where('payment_status', 1)->get();
        return view('my-account', compact('getUserDetails', 'getOrderDetails'));
    }

    public function viewOrderDetails($id) {
        $chkOrder = OrderItem::where('order_id', $id)->count();
        $getOrderDetails = MasterOrder::where('id', $id)->where('payment_status', 1)->first();
        if ($chkOrder > 0) {
            $getOrderItems = OrderItem::with('products')->where('order_id', $id)->get();
        } else {
            return redirect('/my-account');
        }
        return view('order-details', compact('getOrderItems', 'getOrderDetails'));
    }

    public function showMyProfile() {
        $getUserData = UserRegistration::where('id', session()->get('user_id'))->first();
        return view('edit_profile', compact('getUserData'));
    }

    public function updateProfile(Request $request) {
        $allInput = request()->except(['_token']);
        $this->validate($request, [
            'bill_first_name' => 'required',
            'bill_last_name' => 'required',
            'email' => 'required',
            'bill_phone_number' => 'required',
            'bill_address1' => 'required',
            'bill_city' => 'required',
            'bill_state' => 'required',
            'bill_post_code' => 'required',
            'bill_country' => 'required',
        ]);

        $updateProfile = UserRegistration::where('id', session()->get('user_id'))->update($allInput);
        if ($updateProfile) {
            return redirect()->back()->with('success', 'Profile updated successfully.');
        }
    }

    public function forgotPassword() {
        return view('forgot_password');
    }

    public function forgotPasswordCheck(Request $request) {
        $this->validate($request, [
            'email' => 'required',
        ]);
        $chkMailId = UserRegistration::where('email', $request->email)->first();
        if (count($chkMailId) > 0) {
            $password = Str::random();
            $hashPassword = bcrypt($password);
            $email = $request->email;
            $admin_name = getAdminDetails()->name;
            $admin_email = getAdminDetails()->alt_email;
            $mailSend = Mail::send('emails.user_forgot_password', ['name' => $chkMailId->bill_first_name . ' ' . $chkMailId->bill_last_name, 'email' => $request->email, 'password' => $password], function ($message) use ($email) {
                        $message->from(getAdminDetails()->alt_email, 'Pixiedust');
                        $message->subject('Pixiedust :: Forgot Password.');
                        $message->to($email);
                    });
            $passwordUpdate = UserRegistration::where('id', $chkMailId->id)->update(['user_password' => $hashPassword]);
            if ($passwordUpdate) {
                return redirect()->back()->with('success', 'New password send your email.');
            }
        } else {
            return redirect()->back()->with('error', 'Email not found in our record.');
        }
    }

}
