<?php

namespace App\IndiaReads\Repository\Eloquent;

use App\BookViews;
use Illuminate\Database\Eloquent\Model;

/**
* Class BookViewsRepository
* @package App\IndiaReads\Repository\Eloquent
*/
class BookViewsRepository extends EloquentRepository
{
    /**
     * @var model
     */
    protected $model;

    function __construct()
    {
        $this->model = new BookViews();
    }
    public function resetModel()
    {
      $this->model = new BookViews();
    }
}
