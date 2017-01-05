<?php

namespace App\IndiaReads\Repository\Eloquent;

use App\CirculationDiscount;
use Illuminate\Database\Eloquent\Model;
use App\Coupons;

/**
*
*/
class CouponsRepository extends EloquentRepository
{
  /**
   * @var model
   */
  protected $model;

  function __construct()
  {
    $this->model = new Coupons();
  }
}
