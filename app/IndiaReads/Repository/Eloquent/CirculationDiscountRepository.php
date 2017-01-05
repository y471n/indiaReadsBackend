<?php

namespace App\IndiaReads\Repository\Eloquent;

use App\CirculationDiscount;
use Illuminate\Database\Eloquent\Model;


/**
* Class CirculationDiscountRepository
* @package App\IndiaReads\Repository\Eloquent
*/
class CirculationDiscountRepository extends EloquentRepository {

    /**
     * @var Model
     */
    protected $model;

    function __construct() {
        $this->model = new CirculationDiscount();
    }
    public function resetModel()
    {
      $this->model = new CirculationDiscount();
    }
}
