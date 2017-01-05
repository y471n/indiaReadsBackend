<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bookshelf extends Model
{
    protected $table = 'bookshelf';
    public $timestamps = false;
    protected $fillable = array('item_id', 'user_id', 'ISBN13', 'title', 'contributor_name1', 'init_pay', 'shelf_type', 'when');
}
