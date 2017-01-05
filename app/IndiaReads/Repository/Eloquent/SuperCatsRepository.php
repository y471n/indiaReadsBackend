<?php

namespace App\IndiaReads\Repository\Eloquent;

use App\SuperCats;
use Illuminate\Database\Eloquent\Model;

/**
* Class ParentCategoriesRepository
* @package App\IndiaReads\Repository\Eloquent
*/
class SuperCatsRepository extends EloquentRepository
{
  /**
   * @var model
   */
  protected $model;

  function __construct()
  {
    $this->model = new SuperCats();
  }
}
