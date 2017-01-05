<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookshelfOrderTracking extends Model
{
    protected $table = 'bookshelf_order_tracking_details';
    protected $fillable = array('bookshelf_order_id', 'new_delivery');
    public $timestamps = false;
}
