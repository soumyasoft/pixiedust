<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {

    protected $fillable = ['category_id', 'sub_category_id', 'name', 'description', 'slug', 'price', 'discount', 'discount_price', 'shipping_price', 'best_seller', 'image', 'meta_title', 'meta_keywords', 'meta_description'];

    public function category() {
        return $this->belongsTo('App\Category');
    }

    public function subcategories() {
        return $this->belongsTo('App\SubCategory', 'sub_category_id');
    }

    public function productImages() {
        return $this->hasMany('App\ProductImage');
    }

    public function tempcart() {
        return $this->hasMany('App\TempCart', 'product_id');
    }

    public function ordered_items() {
        return $this->hasMany('App\OrderItem');
    }

}
