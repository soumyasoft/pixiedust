<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model {

    protected $fillable = ['order_id', 'product_id', 'unit_price', 'quantity', 'total_price', 'shipping_price'];

    public function products() {
        return $this->belongsTo('App\Product', 'product_id');
    }

    public function masterOrder() {
        return $this->belongsTo('App\MasterOrder');
    }

}
