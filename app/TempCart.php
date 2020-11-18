<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TempCart extends Model {

    protected $fillable = ['user_id', 'session_id', 'product_id', 'unit_price', 'quantity', 'total_price', 'total_shipping_price'];

    public function product() {
        return $this->belongsTo('App\Product');
    }

}
