<?php

namespace App\IndiaReads\Repository\Eloquent;

use App\CatsLevel2;
use Illuminate\Database\Eloquent\Model;

/**
* Class ParentCategoriesRepository
* @package App\IndiaReads\Repository\Eloquent
*/
class CatsLevel2Repository extends EloquentRepository
{
  /**
   * @var model
   */
  protected $model;

  function __construct()
  {
    $this->model = new CatsLevel2();
  }
}
