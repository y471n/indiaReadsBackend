<?php

namespace App\IndiaReads\Repository\Eloquent;

use App\popularHeaderBooks;

class PopularHeaderRepository extends EloquentRepository {

    /**
     * @var Model
     */
    protected $model;

    function __construct() {
        $this->model = new popularHeaderBooks();
    }
}
