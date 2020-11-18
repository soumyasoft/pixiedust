<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CouponCode extends Model {

    protected $fillable = ['coupon_code', 'discount_percentage', 'start_date', 'end_date', 'status'];

}
