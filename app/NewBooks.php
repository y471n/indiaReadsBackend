<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewBooks extends Model {
  /**
   * The database table used by the model
   * @var string
   */
  protected $table = 'new_books';
  public $timestamps = false;
}
