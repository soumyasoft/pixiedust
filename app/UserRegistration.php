<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRegistration extends Model {

    protected $fillable = ['bill_first_name', 'bill_last_name', 'email', 'bill_phone_number', 'user_password', 'bill_address1', 'bill_address2', 'bill_city', 'bill_post_code', 'bill_state', 'bill_country', 'same_for_billing', 'user_status'];

}
