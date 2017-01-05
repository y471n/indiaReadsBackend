<?php

namespace App\IndiaReads\Repository\Eloquent;

use App\BookshelfOrderDetails;
use Illuminate\Database\Eloquent\Model;

/**
* class BookshelfOrderDetailsRepository
* @package App\IndiaReads\Repository\Eloquent
*/
class BookshelfOrderDetailsRepository extends EloquentRepository
{
    /**
     * @var model
     */
    protected $model;

    function __construct()
    {
        $this->model = new BookshelfOrderDetails();
    }

    public function resetModel()
    {
      $this->model = new BookshelfOrderDetails();
    }
}
