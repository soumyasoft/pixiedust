<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\ContactMail;
use \App\Banner;
use \App\CmsPage;
use \App\Product;
use App\Category;
use App\SubCategory;

class HomeController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $getBanners = Banner::get();
        $getNewProducts = Product::orderBy('id', 'desc')->limit(12)->get();
        $getBestSellerProducts = Product::where('best_seller', 1)->orderBy('id', 'desc')->limit(12)->get();
//        dd($getBestSellerProducts);
        return view('home', compact('getBanners', 'getNewProducts', 'getBestSellerProducts'));
    }

    public function aboutUs() {
        $getAboutUs = CmsPage::where('id', 1)->first();
        return view('about-us', compact('getAboutUs'));
    }

    public function privacyPolicy() {
        $getPrivacyPolicy = CmsPage::where('id', 3)->first();
        return view('privacy-policy', compact('getPrivacyPolicy'));
    }

    public function termAndConditions() {
        $getTermAndConditions = CmsPage::where('id', 4)->first();
        return view('term-and-conditions', compact('getTermAndConditions'));
    }

    public function contactUs() {
        return view('contact-us');
    }

    public function sendContactEmail(Request $request) {

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'contact_no' => 'required',
            'enquiry' => 'required',
        ]);

        //dd($request->email);
        //$adminEmail = 'soumya@bletindia.com';
        $adminEmail = getAdminDetails()->alt_email;
        $name = $request->name;
        $email = $request->email;
        $contact_no = $request->contact_no;
        $enquiry = $request->enquiry;
        Mail::send('emails.contact_email', ['name' => $name, 'email' => $email, 'contact_no' => $contact_no, 'enquiry' => $enquiry], function ($message) use ($adminEmail, $email) {

            $message->from($email, 'Pixiedust');
            $message->subject('Contact Email');
            $message->to($adminEmail);
        });

        return redirect()->back()->with('success', 'Your feedback posted successfully.We will gey back you soon.');
    }

    public function getProducts() {
        $getAllProducts = Product::with('category')->orderBy('id', 'DESC')->get();
        return view('products', compact('getAllProducts'));
    }

    public function getProductDetails($slug) {
        if ($slug) {
            $getProductsId = Product::where('slug', $slug)->select('id')->first();
            if ($getProductsId) {
                $getProductDetails = Product::with(['category', 'subcategories', 'productImages'])->where('id', $getProductsId->id)->first();
            }
        }
        return view('product-details', compact('getProductDetails'));
    }

    public function getCategoryProducts($slug) {
        if ($slug) {
            $chkCategoryProducts = Category::where('slug', $slug)->first();
            if ($chkCategoryProducts) {
                $getCatProducts = Product::with('category')->where('category_id', $chkCategoryProducts->id)->get();
                return view('category-products', compact('getCatProducts', 'chkCategoryProducts'));
            }
        }
    }

    public function getSubCategoryProducts() {
        $catSlug = request()->segment(2);
        $subCatSlug = request()->segment(3);
        if ($subCatSlug) {
            $getSubCatProducts = SubCategory::where('slug', $subCatSlug)->with('category', 'products')->first();
            return view('sub-category-products', compact('getSubCatProducts'));
        }
    }

    public function psychicReading() {
        $getReaders = \App\ServiceSchedule::where('id', 1)->select('description')->first();
        $getReadersPrices = \App\IntutivePriceSetting::get();
        //dd($getReadersPrices);
        return view('psychic-reading', compact('getReaders','getReadersPrices'));
    }

    public function massageTherapy() {
        return view('massage-therapy');
    }

}
