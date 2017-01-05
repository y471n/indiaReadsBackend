<?php

namespace App\IndiaReads\Repository\Eloquent;

use App\BookshelfParentOrder;
use Illuminate\Database\Eloquent\Model;


/**
 * Class BookRepository
 * @package App\IndiaReads\Repository\Eloquent
 */
class BookshelfParentOrderRepository extends EloquentRepository {

    /**
     * @var Model
     */
    protected $model;

    function __construct() {
        $this->model = new BookshelfParentOrder();
    }

    public function resetModel()
    {
      $this->model = new BookshelfParentOrder();
    }
}
