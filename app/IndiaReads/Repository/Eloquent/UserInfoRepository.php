<?php

namespace App\IndiaReads\Repository\Eloquent;

use App\UserInfo;
use Illuminate\Database\Eloquent\Model;

/**
 * class UserInfoRepository
 * @package App\IndiaReads\Repository\Eloquent
*/
class UserInfoRepository extends EloquentRepository
{
    /**
     * @var Model
     */
    protected $model;

  function __construct()
  {
    $this->model = new UserInfo();
  }
}
