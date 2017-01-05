<?php

namespace App\IndiaReads\Repository\Eloquent;

use App\BookshelfOrder;
use Illuminate\Database\Eloquent\Model;

/**
* class BookshelfOrderRepository
* @package App\IndiaReads\Repository\Eloquent
*/
class BookshelfOrderRepository extends EloquentRepository
{
  /**
   * @var model
   */
  protected $model;

  function __construct()
  {
    $this->model = new BookshelfOrder();
  }

  public function resetModel()
    {
      $this->model = new BookshelfOrder();
    }
}
