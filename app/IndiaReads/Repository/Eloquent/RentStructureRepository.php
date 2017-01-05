<?php

namespace App\IndiaReads\Repository\Eloquent;

use App\RentStructure;
use Illuminate\Database\Eloquent\Model;


/**
* class RentStructureRepository
* @package App\IndiaReads\Repository\Eloquent
*/
class RentStructureRepository extends EloquentRepository {

    /**
     * @var model
     */
    protected $model;

    function __construct() {
        $this->model = new RentStructure();
    }
}
