<?php

namespace App\IndiaReads\Repository\Eloquent;

use App\Popular;
use Illuminate\Database\Eloquent\Model;


/**
 * Class BookRepository
 * @package App\IndiaReads\Repository\Eloquent
 */
class PopularRepository extends EloquentRepository {

    /**
     * @var Model
     */
    protected $model;

    function __construct() {
        $this->model = new Popular();
    }

    public function resetModel()
    {
      $this->model = new Popular();
    }
}
