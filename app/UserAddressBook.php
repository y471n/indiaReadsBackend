<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAddressBook extends Model
{
    protected $table = 'user_address_book';
    protected $fillable = array('user_id', 'fullname', 'address_line1', 'address_line2', 'city', 'state', 'pincode', 'phone');
    public $timestamps = false;
}
