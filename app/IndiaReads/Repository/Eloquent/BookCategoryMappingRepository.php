<?php

namespace App\IndiaReads\Repository\Eloquent;

use App\BookCategoryMapping;
use Illuminate\Database\Eloquent\Model;

/**
* Class BookCategoryMappingRepository
* @package App\IndiaReads\Repository\Eloquent
*/
class BookCategoryMappingRepository extends EloquentRepository {

    /**
     * @var model
     */
    protected $model;

    function __construct() {
        $this->model = new BookCategoryMapping();
    }
    public function resetModel()
    {
      $this->model = new BookCategoryMapping();
    }
}
