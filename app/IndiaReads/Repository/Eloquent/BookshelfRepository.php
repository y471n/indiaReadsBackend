<?php

namespace App\IndiaReads\Repository\Eloquent;

use App\Bookshelf;
use Illuminate\Database\Eloquent\Model;

/**
* class BookshelfOrderRepository
* @package App\IndiaReads\Repository\Eloquent
*/
class BookshelfRepository extends EloquentRepository
{
  /**
   * @var model
   */
  protected $model;

  function __construct()
  {
    $this->model = new Bookshelf();
  }
}
