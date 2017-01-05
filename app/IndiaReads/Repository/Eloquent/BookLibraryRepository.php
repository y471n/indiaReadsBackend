<?php

namespace App\IndiaReads\Repository\Eloquent;

use App\BookLibrary;
use Illuminate\Database\Eloquent\Model;

/**
* Class BookLibraryRepository
* @package App\IndiaReads\Repository\Eloquent
*/
class BookLibraryRepository extends EloquentRepository {
    /**
     * @var model
     */
    protected $model;

    function __construct() {
        $this->model = new BookLibrary();
    }

    public function resetModel()
    {
      $this->model = new BookLibrary();
    }
}
