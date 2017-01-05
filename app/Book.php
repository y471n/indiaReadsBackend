<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model {
    /**
     * The database table used by the model
     * @var string
     */
    protected $table = 'sub_mastersheet';
    public $timestamps = false;
}
