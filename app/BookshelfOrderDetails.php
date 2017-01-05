<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookshelfOrderDetails extends Model {
    protected $table = 'bookshelf_order_details';
    protected $fillable = array('user_id', 'items_count', 'order_address_id', 'price', 'payment_status', 'order_address_id', 'store_discount', 'shipping_charge', 'cod_charge', 'net_pay', 'payment_option', 'payment_status');
    public $timestamps = false;
}
