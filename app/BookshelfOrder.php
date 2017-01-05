<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookshelfOrder extends Model
{
    protected $table = 'bookshelf_order';
    public $timestamps = false;
    protected $fillable = array('user_id', 'ISBN13', 'unique_book_id', 'inventory_id', 'mrp', 'init_pay', 'store_pay');
}
