<?php

namespace App\IndiaReads\Repository\Eloquent;

use App\ParentCategories;
use Illuminate\Database\Eloquent\Model;

/**
* Class ParentCategoriesRepository
* @package App\IndiaReads\Repository\Eloquent
*/
class ParentCategoriesRepository extends EloquentRepository
{
  /**
   * @var model
   */
  protected $model;

  function __construct()
  {
    $this->model = new ParentCategories();
  }
}
