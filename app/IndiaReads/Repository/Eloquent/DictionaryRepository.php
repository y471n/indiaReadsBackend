<?php

namespace App\IndiaReads\Repository\Eloquent;

use App\CirculationDiscount;
use Illuminate\Database\Eloquent\Model;
use App\Dictionary;

/**
* class Dictionary Repository
* @package App\IndiaReads\Repository\Eloquent
*/
class DictionaryRepository extends EloquentRepository
{
    /**
     * @var model
     */
    protected $model;

    function __construct()
    {
        $this->model = new Dictionary();
    }
}
