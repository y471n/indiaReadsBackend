<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Popular extends Model {
    /**
     * The database table used by the model
     * @var string
     */
    protected $table = 'popular_books';
    public $timestamps = false;
}
