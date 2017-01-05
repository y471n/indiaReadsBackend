<?php

namespace App\IndiaReads\Repository\Eloquent;

use App\UserStoreCreditDetails;
use Illuminate\Database\Eloquent\Model;

/**
* Class UserStoreCreditDetailsRepository
* @package App\IndiaReads\Repository\Eloquent
*/
class UserStoreCreditDetailsRepository extends EloquentRepository
{
  /**
   * @var Model
   */
  protected $model;

  function __construct()
  {
    $this->model = new UserStoreCreditDetails();
  }

      public function resetModel()
    {
      $this->model = new UserStoreCreditDetails();
    }
}
