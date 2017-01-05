<?php

namespace App\IndiaReads\Repository\Eloquent;

use App\recommendedHeaderBooks;

class RecommendedHeaderRepository extends EloquentRepository {

    /**
     * @var Model
     */
    protected $model;

    function __construct() {
        $this->model = new recommendedHeaderBooks();
    }
}
