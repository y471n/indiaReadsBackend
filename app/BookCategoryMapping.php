<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookCategoryMapping extends Model {
  /**
   * The database table used by the model
   * @var string
   */
  protected $table = 'book_category_mapping';
  public $timestamps = false;
}
