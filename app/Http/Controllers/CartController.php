<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\TempCart;
use App\MasterOrder;
use App\OrderItem;
use App\PaymentSetting;
use Mail;
use App\CouponCode;
use App\UserRegistration;
use Response;

class CartController extends Controller {

    public function addToCart(Request $request) {
        $allInput = request()->except(['_token']);
        //dd($allInput);
        $session_id = session()->getId();
        $quantity = $request->quantity;
        $product_id = $request->product_id;
        if ($quantity == 0 || $product_id == "") {
            return redirect("/products");
        }

        #############  Get Product Details From Helper(app/Helpers/helpers.php) ############
        $productDetails = getProductDetails($product_id);
        $unitPrice = $productDetails->discount_price ? $productDetails->discount_price : $productDetails->price;
        $totalPrice = $unitPrice * $quantity;
        $shippingPrice = $productDetails->shipping_price * $quantity;

        ###########  Check product exists or not in Cart Table ##################
        $productCount = TempCart::where([['product_id', $product_id], ['session_id', $session_id]])->count();
        $cartProdInfo = cartProdInfo($product_id, $session_id);
        if (!empty($cartProdInfo)) {
            $cartTotal = $totalPrice + $cartProdInfo->total_price;
            $totalQty = $quantity + $cartProdInfo->quantity;
            $totalShippingPrice = $shippingPrice + $cartProdInfo->total_shipping_price;
        } else {
            $cartTotal = $totalPrice;
            $totalQty = $quantity;
            $totalShippingPrice = $shippingPrice;
        }
        $userId = session()->get('user_id');
        $allInput['user_id'] = $userId;
        $allInput['session_id'] = $session_id;
        $allInput['quantity'] = $totalQty;
        $allInput['total_price'] = $cartTotal;
        $allInput['unit_price'] = $unitPrice;
        $allInput['total_shipping_price'] = $totalShippingPrice;

        if ($productCount == 0) {
            TempCart::create($allInput);
        } else {
            TempCart::where([['product_id', $product_id], ['session_id', $session_id]])->update($allInput);
        }
        $totalCartPrice = TempCart::where('session_id', $session_id)->sum('total_price');
        session()->put('total_cart_price', $totalCartPrice);
        return redirect('cart');
    }

    public function showCart() {
        $session_id = session()->getId();
        $getCartProducts = TempCart::where('session_id', $session_id)->with('product')->orderBy('id', 'DESC')->get();
        //dd($getCartProducts);

        if (session()->get('discount_percentage') != "") {
            $getDiscountCal = disCountCal(session()->get('discount_percentage'));
            return view('cart', compact('getCartProducts', 'getDiscountCal'));
        } else {
            $getDiscountCal = array('discountAmount' => "0", 'afterDiscountAmt' => "0.00", 'totalPayble' => "0.00", 'discount_percentage' => "0.00");
            return view('cart', compact('getCartProducts', 'getDiscountCal'));
        }
    }

    ###############  Update Cart Item #######################

    public function updateCartItem(Request $request) {
        $allInput = request()->except(['_token']);
        $session_id = session()->getId();
        $getProdId = singleCartProdInfo($request->input('update_cart_id'));
        $prodDetails = getProductDetails($getProdId->product_id);
        $totalPrice = $request->input('update_qty') * $request->input('update_unit_price');
        $totalShippingPrice = $request->input('update_qty') * $prodDetails->shipping_price;
        $updateArr = ['total_price' => $totalPrice, 'total_shipping_price' => $totalShippingPrice, 'quantity' => $request->input('update_qty')];

        TempCart::where([['id', $request->input('update_cart_id')], ['session_id', $session_id]])->update($updateArr);
        $cartDetails = cartDetails();
        if (session()->get('discount_percentage') != "") {
            $getDiscountCal = disCountCal(session()->get('discount_percentage'));
            return Response::json(['cartDetails' => $cartDetails, 'getDiscountCal' => $getDiscountCal, 'status' => 'success']);
        } else {
            return Response::json(['cartDetails' => $cartDetails, 'status' => 'success']);
        }
    }

    ########### DELETE ITEM FROM CART #################

    public function deleteCartItem(Request $request) {
        $cartId = $request->cart_id;

        $deleteCart = TempCart::destroy($cartId);
        if ($deleteCart) {
            $cartDetails = cartDetails();

            if ($cartDetails->total_quantity == null) {
                session()->forget('coupon_code');
                session()->forget('discount_percentage');
            }

            if (session()->get('discount_percentage') != "") {
                $getDiscountCal = disCountCal(session()->get('discount_percentage'));
                return Response::json(['cartDetails' => $cartDetails, 'getDiscountCal' => $getDiscountCal, 'status' => 'success']);
            } else {
                return Response::json(['cartDetails' => $cartDetails, 'status' => 'success']);
            }
        }
    }

    ######### Coupon Code Apply ###############

    public function applyCouponcode(Request $request) {

        $today = date("Y-m-d");
        $chkCupnExt = CouponCode::where([['coupon_code', $request->couponcode], ['status', '1'], ['start_date', '<=', $today], ['end_date', '>=', $today]])->count();
        if ($chkCupnExt == 0) {
            return Response::json(['status' => 'not_exist']);
        } else {
            $cartDetails = cartDetails();
            $couponDtls = CouponCode::where('coupon_code', $request->couponcode)->select('discount_percentage')->first();
            $discountAmount = number_format($cartDetails->total_price * $couponDtls->discount_percentage / 100, 2);
            $afterDiscountAmt = number_format(($cartDetails->total_price) - $discountAmount, 2);
            if ($cartDetails->total_price >= 50) {
                $totalPayble = number_format($afterDiscountAmt + 0.00, 2);
            } else {
                $totalPayble = number_format($afterDiscountAmt + $cartDetails->total_shipping_price, 2);
            }
            session(['discount_percentage' => $couponDtls->discount_percentage]);
            session(['coupon_code' => $request->couponcode]);
            return Response::json(['status' => 'success', 'discountAmount' => $discountAmount, 'afterDiscountAmt' => $afterDiscountAmt, 'totalPayble' => $totalPayble, 'discount_percentage' => $couponDtls->discount_percentage]);
        }
    }

    #######  Check Out Code ##############

    function checkout() {
        //session()->forget('user_id');
        $session_id = session()->getId();
        $getCartProducts = TempCart::where('session_id', $session_id)->with('product')->orderBy('id', 'DESC')->get();
        if (session()->get('discount_percentage') != "") {
            $getDiscountCal = disCountCal(session()->get('discount_percentage'));
        } else {
            $getDiscountCal = array('discountAmount' => "0.00", 'afterDiscountAmt' => "0.00", 'totalPayble' => "0.00", 'discount_percentage' => "0.00");
        }
        $user_details = UserRegistration::where('id', session()->get('user_id'))->first();
        if ($getCartProducts->count() > 0) {
            return view('checkout', compact('getCartProducts', 'getDiscountCal', 'user_details'));
        } else {
            return redirect('/cart');
        }
    }

    public function placeOrder(Request $request) {
        $session_id = session()->getId();
        $allInput = $request->all();
        $same_for_billing = ($request->input('same_for_billing')) ? trim($request->input('same_for_billing')) : 0;
        $userCount = UserRegistration::where('email', '=', $request->email)->count();

        if ($request->bill_first_name == "" || $request->bill_last_name == "" || $request->email == "" || $request->bill_phone_number == "" || $request->bill_address1 == "" || $request->bill_city == "" || $request->bill_post_code == "" || $request->bill_country == "" || $request->bill_state == "") {
            return Response::json(['status' => 'blank', 'msg' => "Billing fields are blank."]);
        } else if ($request->account_password == "" && session()->get('user_id') == "") {
            return Response::json(['status' => 'pass_blank', 'msg' => "Account Password blank."]);
        } else if ($userCount > 0 && session()->get('user_id') == "") {
            return Response::json(['status' => 'email_exists', 'msg' => "Email already already exists."]);
        } else if ($same_for_billing == 1 && ($request->ship_first_name == "" || $request->ship_last_name == "" || $request->ship_phone_number == "" || $request->ship_address1 == "" || $request->ship_city == "" || $request->ship_post_code == "" || $request->ship_country == "" || $request->ship_state == "")) {
            return Response::json(['status' => 'ship_det_blank', 'msg' => "Please enter shipping details."]);
        } else {

            if (session()->get('user_id') == "") {
                $user_password = bcrypt($request->account_password);
                $email = $request->email;
                $allInput['user_status'] = 1;
                $allInput['user_password'] = $user_password;
                $allInput['same_for_billing'] = $same_for_billing;
                $saveReg = UserRegistration::create($allInput);
                $user_id = $saveReg->id;
                session(['user_id' => $user_id]);
                session(['user_name' => $request->bill_first_name . ' ' . $request->bill_last_name]);
//######################User Registration mail goes to user#################
// Admin Details
                $admin_name = getAdminDetails()->name;
                $admin_email = getAdminDetails()->alt_email;
                $mailSend = Mail::send('emails.user_registration_email', ['name' => $request->bill_first_name . ' ' . $request->bill_last_name, 'email' => $request->email, 'password' => $request->account_password], function ($message) use ($email) {
                            $message->from(getAdminDetails()->alt_email, 'Pixiedust');
                            $message->subject('Pixiedust :: Login credentials.');
                            $message->to($email);
                        });
            }
            $allInput['user_id'] = (session()->get('user_id')) ? session()->get('user_id') : NULL;
            if ($request->ship_first_name && $request->ship_last_name) {
                $fullName = $request->ship_first_name . ' ' . $request->ship_last_name;
            } else {
                $fullName = $request->bill_first_name . ' ' . $request->bill_last_name;
            }
            $allInput['ship_full_name'] = $fullName;
            $allInput['ship_phone_number'] = $request->ship_phone_number ? $request->ship_phone_number : $request->bill_phone_number;
            $allInput['ship_address1'] = $request->ship_address1 ? $request->ship_address1 : $request->bill_address1;
            $allInput['ship_address2'] = $request->ship_address2 ? $request->ship_address2 : $request->bill_address2;
            $allInput['ship_city'] = $request->ship_city ? $request->ship_city : $request->bill_city;
            $allInput['ship_post_code'] = $request->ship_post_code ? $request->ship_city : $request->bill_post_code;
            $allInput['ship_state'] = $request->ship_state ? $request->ship_state : $request->bill_state;
            $allInput['ship_country'] = $request->ship_country ? $request->ship_country : $request->bill_country;
            $getDiscountCal = disCountCal(session()->get('discount_percentage'));
            if (session()->get('discount_percentage')) {
                $allInput['total_amount'] = cartDetails()->total_price > 50 ? $getDiscountCal['afterDiscountAmt'] + 0.00 : number_format($getDiscountCal['afterDiscountAmt'] + cartDetails()->total_shipping_price, 2);
            } else {
                $allInput['total_amount'] = cartDetails()->total_price > 50 ? cartDetails()->total_price + 0.00 : number_format(cartDetails()->total_price + cartDetails()->total_shipping_price, 2);
            }
            $allInput['discount_amount'] = session()->get('discount_percentage') ? number_format($getDiscountCal['discountAmount'], 2) : "0.00";
            $allInput['discount_percentage'] = session()->get('discount_percentage');
            $allInput['coupon_code'] = session()->get('coupon_code');
            $allInput['shipping_amount'] = cartDetails()->total_price > 50 ? "0.00" : cartDetails()->total_shipping_price;
            $saveMasterAll = MasterOrder::create($allInput);
            $orderID = $saveMasterAll->id;
            session(['order_id' => $orderID]);
            $session_id = session()->getId();
            $cartDatas = TempCart::where('session_id', $session_id)->get();
            $allItemData = [];
            foreach ($cartDatas as $cartData) {
                $allItemData['order_id'] = $orderID;
                $allItemData['product_id'] = $cartData->product_id;
                $allItemData['unit_price'] = $cartData->unit_price;
                $allItemData['quantity'] = $cartData->quantity;
                $allItemData['total_price'] = $cartData->total_price;
                $allItemData['shipping_price'] = $cartData->total_shipping_price;
                $saveCartItems = OrderItem::create($allItemData);
            }

            $deleteTempProduct = TempCart::where('session_id', $session_id)->delete();

            session()->forget('coupon_code');
            session()->forget('discount_percentage');
            return Response::json(['status' => 'success', 'msg' => "Ordered Successfully."]);
        }
    }

    public function showPaypal() {
        $getAdminDetls = getAdminDetails();
        $paymentSetting = PaymentSetting::first();
        $orderId = session()->get('order_id');
        $orderedItems = OrderItem::with('products')->where('order_id', $orderId)->get();
        //dd($orderedItems);
        $getMasterOrders = MasterOrder::where('id', $orderId)->first();
        if ($paymentSetting->paypal_environment == 1) {
            $URL = "https://www.sandbox.paypal.com/cgi-bin/webscr";
        } else {
            $URL = "https://www.paypal.com/cgi-bin/webscr";
        }
        return view('paypal', compact('getAdminDetls', 'paymentSetting', 'orderedItems', 'getMasterOrders', 'URL'));
    }

    public function showThankyou() {
        return view('thank_you');
    }

    public function updateTransactionDetails() {

//        $fp = fopen("ipnresult1.txt", "w");
//        foreach ($_POST as $key => $value) {
//            fwrite($fp, $key . '====' . $value . "\n");
//        }
        $order_id = $_POST['custom'];
        $txn_id = $_POST['txn_id'];

        $updateTransaction = MasterOrder::where('id', $order_id)->update(['transaction_id' => $txn_id, 'payment_status' => 1]);
        $getOrderDetails = MasterOrder::where('id', $order_id)->with('orderItems')->first();
        $data = array(
            'order_id' => $order_id,
            'email' => $getOrderDetails->email,
            'ship_full_name' => $getOrderDetails->ship_full_name,
        );
        $pdf = PDF::loadView('emails.pixiedust-invoice', compact('getOrderDetails'));
        $data['subject'] = 'Pixiedust :: Order Placed';
        Mail::send('emails.place-order-email', compact('data'), function($message) use ($data, $pdf) {
            $message->to($data['email']);
            $message->subject($data['subject']);
            $message->from(getAdminDetails()->alt_email);
            $message->attachData($pdf->stream(), "invoice.pdf");
        });
        session()->forget('order_id');
    }

}
