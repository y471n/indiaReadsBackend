<?php

namespace App\IndiaReads\Repository\Eloquent;

use App\newHeaderBooks;

class NewHeaderRepository extends EloquentRepository {

    /**
     * @var Model
     */
    protected $model;

    function __construct() {
        $this->model = new newHeaderBooks();
    }
}
