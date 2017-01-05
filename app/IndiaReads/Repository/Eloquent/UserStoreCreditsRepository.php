<?php

namespace App\IndiaReads\Repository\Eloquent;

use App\UserStoreCredits;
use Illuminate\Database\Eloquent\Model;

/**
* Class UserStoreCreditRepository
* @package App\IndiaReads\Repository\Eloquent
*/
class UserStoreCreditsRepository extends EloquentRepository
{
  /**
   * @var Model
   */
  protected $model;

  function __construct()
  {
    $this->model = new UserStoreCredits();
  }
}
