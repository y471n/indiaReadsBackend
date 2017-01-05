<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrendingBooks extends Model {
  /**
   * The database table used by the model
   * @var string
   */
  protected $table = 'trending_books';
  public $timestamps = false;
}
