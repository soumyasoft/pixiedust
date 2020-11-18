<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use \App\ProductImage;
use \App\SubCategory;
use \App\MasterOrder;
use PDF;
use Mail;
use Response;

class AjaxController extends Controller {

    public function saveNewsLetterData(Request $request) {

        $count = NewsLetter::where('email', $request->email)->count();
        //dd($count);
        if ($count == 0) {
            $saveNewsLetter = NewsLetter::create($request->all());
            if ($saveNewsLetter) {
                return response()->json(['status' => 'success']);
            }
        } else {
            return response()->json(['status' => 'exists']);
        }
    }

    public function getSubCategory(Request $request) {
        $getSubCategories = SubCategory::where('category_id', $request->cat_id)->pluck('name', 'id');
        if (!empty($getSubCategories)) {
            return Response::json($getSubCategories);
        }
    }

    public function delMulImage(Request $request) {
        $getMulImage = ProductImage::where('id', $request->id)->first();
        if (!empty($getMulImage)) {
            $prodMulImage = public_path('images/products/multiple_images/' . $getMulImage->image);
            if (file_exists($prodMulImage)) {
                unlink($prodMulImage);
            }
        }
        $delMulImg = ProductImage::destroy($request->id);
        if ($delMulImg) {
            return response()->json(['status' => 'success']);
        } else {
            return response()->json(['status' => 'error']);
        }
    }

    public function updateShipping(request $request) {
        $allInput = request()->except(['_token', 'order_id']);
        $allInput['shipping_date'] = date("Y-m-d");
        $updateShipping = MasterOrder::where('id', $request->order_id)->update($allInput);
        if ($updateShipping) {
            $getOderDetls = MasterOrder::where('id', $request->order_id)->select('email')->first();
            $getOrderDetails = MasterOrder::where('id', $request->order_id)->with('orderItems')->first();
            $data = array(
                'order_id' => $request->order_id,
                'shipping_url' => $request->shipping_url,
                'tracking_id' => $request->tracking_id,
                'email' => $getOderDetls->email,
                'ship_full_name' => $getOderDetls->ship_full_name,
                'shipping_date' => date('Y-m-d'),
            );
            $data['subject'] = 'Pixiedust :: Order Shipped';
            Mail::send('emails.order_ship_email', compact('data'), function($message) use ($data) {
                $message->to($data['email']);
                $message->subject($data['subject']);
                $message->from(getAdminDetails()->alt_email);
            });
            return response()->json(['success' => "success", 'msg' => 'Your order has been shipped successfully.']);
            exit;
        }
    }

}
