<?php

namespace App\IndiaReads\Repository\Eloquent;

use App\Book;
use Illuminate\Database\Eloquent\Model;


/**
 * Class BookRepository
 * @package App\IndiaReads\Repository\Eloquent
 */
class BookRepository extends EloquentRepository {

    /**
     * @var Model
     */
    protected $model;

    function __construct() {
        $this->model = new Book();
    }

    public function resetModel()
    {
      $this->model = new Book();
    }
}
