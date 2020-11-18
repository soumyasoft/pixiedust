<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Hash;

use App\Banner;
use App\Product;
use \App\ProductImage;
use \App\Category;
use \App\SubCategory;
use \App\UserRegistration;




class ApiController extends Controller {
	#########  Get All Banners ##################
	public function getBanners() {
		$getBanners = Banner::select('banner')->get();
		$bannerImg = [];
		if ($getBanners->count() > 0) {
			foreach ($getBanners as $getBanner) {
				$bannerImg[] = asset('public/images/banner/' . $getBanner->banner);
			}
			return response()->json(['status' => 'success', 'bannerData' => $bannerImg]);
		} else {
			return response()->json(['status' => 'error', 'bannerData' => $bannerImg]);
		}
	}

    ############# Get All Products ###################
	//http://192.168.0.111/pixiedust/api/products
    public function getAllProducts() {
	  $getAllProducts = Product::select('id', 'category_id', 'sub_category_id', 'name', 'description', 'price', 'discount', 'discount_price', 'shipping_price', 'image')->get();
	  
	  $prodata = [];
	  $path = asset('public/images/products/multiple_images/')."/";
	  if ($getAllProducts->count() > 0) {
		  foreach ($getAllProducts as $key => $getAllProduct) {
			  $prodata[] = $getAllProduct;
			  $prodata[$key]['image'] = asset('public/images/products/' . $getAllProduct->image);
			  $prodata[$key]['discount'] = "$getAllProduct->discount";
			  $prodata[$key]['discount_price'] = $getAllProduct->discount_price == null ? "" : $getAllProduct->discount_price;
			  
			  //$opt_ph_ary = ProductImage::select('image')->where('product_id', $getAllProduct->id)->get();
			  $opt_ph_ary = ProductImage::select(DB::raw("concat('".$path."',image) as image"))->where('product_id',$getAllProduct->id)->get();
			  $prodata[$key]['opt_img']= $opt_ph_ary;
		  }
		  return response()->json(['status' => 'success', 'productList' => $prodata]);
	  } else {
		  return response()->json(['status' => 'error', 'message' => 'No products uploadd']);
	  }
    }
	
	############# Get Home page Products ###################
	//http://192.168.0.111/pixiedust/api/home-products
	public function getHomePageProducts() {
	  //Latest Product
	  $latest_prd = Product::select('id', 'category_id', 'sub_category_id', 'name', 'description', 'price', 'discount', 'discount_price', 'shipping_price', 'image')->orderBy('id', 'DESC')->take(10)->get();
	  
	  $prd_ary = [];
	  $path = asset('public/images/products/multiple_images/')."/";
	  foreach ($latest_prd as $key => $latest_prd) {
		$prd_ary[] = $latest_prd;
		$prd_ary[$key]['image'] = asset('public/images/products/' . $latest_prd->image);
		$prd_ary[$key]['discount'] = "$latest_prd->discount";
		$prd_ary[$key]['discount_price'] = $latest_prd->discount_price == null ? "" : $latest_prd->discount_price;
		
		
		//$opt_ph_ary = DB::select("SELECT concat('".$path."',image) as abc FROM product_images where ".$latest_prd->id);
		$opt_ph_ary = ProductImage::select(DB::raw("concat('".$path."',image) as image"))->where('product_id',$latest_prd->id)->get();
		$prd_ary[$key]['opt_img']= $opt_ph_ary;
	  }
	  
	  //Best Seller Product
	  $best_prd = Product::where('best_seller',1)->select('id', 'category_id', 'sub_category_id', 'name', 'description', 'price', 'discount', 'discount_price', 'shipping_price', 'image','best_seller')->orderBy('id', 'DESC')->take(10)->get();
	  
	  $prd_ary_bs = [];
	  foreach ($best_prd as $best_prd_key => $best_prd) {
		$prd_ary_bs[] = $best_prd;
		$prd_ary_bs[$best_prd_key]['image'] = asset('public/images/products/' . $best_prd->image);
		$prd_ary_bs[$best_prd_key]['discount'] = "$best_prd->discount";
		$prd_ary_bs[$best_prd_key]['discount_price'] = $best_prd->discount_price == null ? "" : $latest_prd->discount_price;
		
		//$opt_ph_ary_bs = ProductImage::select('image')->where('product_id', $best_prd->id)->get();
		$opt_ph_ary_bs = ProductImage::select(DB::raw("concat('".$path."',image) as image"))->where('product_id',$best_prd->id)->get();
		$prd_ary_bs[$best_prd_key]['opt_img']= $opt_ph_ary_bs;
	  }
	  return response()->json(['status' => 'success', 'newInProducts' => $prd_ary,'bestSellerProduct' => $prd_ary_bs]);
	}
	
	//http://192.168.0.111/pixiedust/api/all-cat-subcat
	public function getAllCategorySubcategory() {
	  $cat_rec = Category::select('id','name', 'image')->get();
	  $cat_ary = [];
	  if ($cat_rec->count() > 0) {
		  foreach ($cat_rec as $cat_key => $cat_val) {
			  $cat_ary[] = $cat_val;
			  $cat_ary[$cat_key]['image'] = asset('public/images/product-category/' . $cat_val->image);
			  $sub_cat_ary = SubCategory::select('id','name')->where('category_id',$cat_val->id)->get();
			  $cat_ary[$cat_key]['sub_cat']= $sub_cat_ary;
		  }
		  return response()->json(['status' => 'success', 'catSubcatList' => $cat_ary]);
	  } else {
		  return response()->json(['status' => 'error', 'message' => 'No products uploadd']);
	  }
    }
    
	//http://192.168.0.111/pixiedust/api/user-login?data={"login_email":"soumyadas02009@gmail.com","login_psw":"1234567"}
	public function userLogin(Request $request){
		$jsonData = json_decode($request->input('data'));
		$user_email = $jsonData->login_email;
		$user_password = $jsonData->login_psw;
		
        if ($user_email == "" || $user_password == "") {
		   return response()->json(['status' => 'error', 'message' => 'Please enter email & password']);
        }
		
		// Get records from core table with email address
		$result = UserRegistration::select(DB::raw("id,user_password,concat(bill_first_name,' ',bill_last_name) as full_name"))->where('email',$user_email)->first();
		
		if($result==NULL){
			return response()->json(['status' => 'error', 'message' => 'Invalid email/password.']);
		}else if ($result!=NULL && Hash::check($user_password,$result->user_password)==false) {
			return response()->json(['status' => 'error', 'message' => 'Invalid email/password.']);
        }else{
			unset($result['user_password']);
			return response()->json(['status' => 'success', 'dataResponse' => $result]);
		}
	}
	
	
	//http://192.168.0.111/pixiedust/api/user-details?data={"user_id":11}
	public function fetchUserDetails(Request $request){
		$jsonData = json_decode($request->input('data'));
        $user_id = $jsonData->user_id;
		
		//$result_array = array();
		$user_det = UserRegistration::select('id','bill_first_name','bill_last_name','email','bill_phone_number','bill_address1','bill_address2','bill_city','bill_post_code','bill_state','bill_country')->where('id',$user_id)->first();
		
		if($user_det!=null){
			$user_det['bill_post_code'] = "$user_det->bill_post_code";
			return response()->json(['status' => 'success', 'dataResponse' => $user_det]);
		}else{
			echo '{"status":"error","message":"No Record found"}';exit;
		}
	}
	
	
	//http://192.168.0.111/pixiedust/api/user-change-password?data={"user_id":11,"old_psw":17,"new_psw":18}	
	public function userChangePassword(Request $request){
		$jsonData = json_decode($request->input('data'));
		$user_id = $jsonData->user_id;
		$old_psw = $jsonData->old_psw;
		$new_psw = $jsonData->new_psw;
		
		if($old_psw == "" || $new_psw == "") {
			return response()->json(['status' => 'error', 'message' => 'Please enter old & new password']);
		}
		
		$user_data = UserRegistration::select(DB::raw("id,user_password,concat(bill_first_name,' ',bill_last_name) as full_name"))->where('id',$user_id)->first();
		
		if ($user_data!=NULL && Hash::check($old_psw,$user_data->user_password)==false) {
			return response()->json(['status' => 'error', 'message' => 'Invalid old password.']);
        }else{
			//UserRegistration::where('id', $user_id)->update(['user_password' => Hash::make($new_psw)]);
			return response()->json(['status' => 'success', 'message' => 'Password has been changed successfully.']);
		}
	}
	
	

}
