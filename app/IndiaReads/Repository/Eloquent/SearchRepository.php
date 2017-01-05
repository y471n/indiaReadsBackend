<?php

namespace App\IndiaReads\Repository\Eloquent;

use App\Search;
use Illuminate\Database\Eloquent\Model;


/**
 * Class SearchRepository
 * @package App\IndiaReads\Repository\Eloquent
 */
class SearchRepository extends EloquentRepository {

    /**
     * @var Model
     */
    protected $model;

    function __construct()
    {
        $this->model = new Search();
    }
}
