<?php

namespace App\IndiaReads\Repository\Eloquent;

use App\BookshelfOrderTracking;
use Illuminate\Database\Eloquent\Model;

/**
* class BookshelfOrderRepository
* @package App\IndiaReads\Repository\Eloquent
*/
class BookshelfOrderTrackingRepository extends EloquentRepository
{
  /**
   * @var model
   */
  protected $model;

  function __construct()
  {
    $this->model = new BookshelfOrderTracking();
  }
}
