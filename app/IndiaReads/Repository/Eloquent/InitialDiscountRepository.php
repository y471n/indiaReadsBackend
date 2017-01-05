<?php

namespace App\IndiaReads\Repository\Eloquent;

use App\InitialDiscount;
use Illuminate\Database\Eloquent\Model;

/**
* Class InitialDiscountRepository
* @package App\IndiaReads\Repository\Eloquent
*/
class InitialDiscountRepository extends EloquentRepository
{
    /**
     * @var Model
     */
    protected $model;

    function __construct()
    {
        $this->model = new InitialDiscount();
    }
    public function resetModel()
    {
      $this->model = new InitialDiscount();
    }
}
