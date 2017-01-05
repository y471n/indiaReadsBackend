<?php

namespace App\IndiaReads\Repository\Eloquent;

use App\NewBooks;
use Illuminate\Database\Eloquent\Model;

/**
* Class NewBooksRepository
* @package App\IndiaReads\Repository\Eloquent
*/
class NewBooksRepository extends EloquentRepository {
    /**
     * @var model
     */
    protected $model;

    function __construct() {
        $this->model = new NewBooks();
    }
}
