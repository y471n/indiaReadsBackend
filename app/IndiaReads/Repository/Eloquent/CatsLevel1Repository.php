<?php

namespace App\IndiaReads\Repository\Eloquent;

use App\CatsLevel1;
use Illuminate\Database\Eloquent\Model;

/**
* Class ParentCategoriesRepository
* @package App\IndiaReads\Repository\Eloquent
*/
class CatsLevel1Repository extends EloquentRepository
{
  /**
   * @var model
   */
  protected $model;

  function __construct()
  {
    $this->model = new CatsLevel1();
  }
}
