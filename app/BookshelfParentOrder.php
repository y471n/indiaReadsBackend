<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookshelfParentOrder extends Model
{
    protected $table = 'bookshelf_parent_order';
    protected $fillable = array('p_order_id', 'bookshelf_order_id');
    public $timestamps = false;
}
