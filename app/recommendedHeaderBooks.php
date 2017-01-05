<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class recommendedHeaderBooks extends Model {
    /**
     * The database table used by the model
     * @var string
     */
    protected $table = 'recommended_header_books';
    public $timestamps = false;
}