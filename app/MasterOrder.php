<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterOrder extends Model {

    protected $fillable = ['user_id', 'bill_first_name', 'bill_last_name', 'email', 'bill_phone_number', 'user_password', 'bill_address1', 'bill_address2', 'bill_city', 'bill_post_code', 'bill_state', 'bill_country', 'ship_full_name', 'ship_phone_number', 'ship_address1', 'ship_address2', 'ship_city', 'ship_post_code', 'ship_state', 'ship_country', 'total_amount', 'discount_amount', 'discount_percentage', 'coupon_code', 'shipping_amount', 'transaction_id', 'payment_status', 'order_status', 'shipping_date', 'order_notes', 'shipping_url', 'tracking_id'];

    public function orderItems() {
        return $this->hasMany('App\OrderItem', 'order_id');
    }

}
