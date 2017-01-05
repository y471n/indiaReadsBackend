<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookLibrary extends Model
{
    /**
     * The database table used by the model
     * @var string
     */
    protected $table = 'book_library_new';
    public $timestamps = false;
    protected $fillable = array('status', 'last_circulated_on');
}
